<?php

namespace GMC\Http\Controllers;

use Illuminate\Http\Request;
use GMC\Services\Containers\AudienceContainer as AudienceRepository;
use Validator;
use GMC\Layer;
use GMC\Models\Audience;

class AudienceController extends Controller {

    public function index() {
        return view('audiences.audience.index');
    }

    public function bootgrid(Request $request) {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'audienceId';
        $sortType = 'DESC';

        if (is_array($request->input('sort'))) :
            foreach ($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        $rows = AudienceRepository::Audience()->where('audienceId', 'LIKE', '%' . $search . '%')
                ->orWhereHas('activities', function($query) use($search) {
                    $query->where('activityName', 'LIKE', '%' . $search . '%');
                })
                ->with('activities', 'layers')
                ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                ->get();

        $total = AudienceRepository::Audience()->where('audienceId', 'LIKE', '%' . $search . '%')
                ->orWhereHas('activities', function($query) use($search) {
                    $query->where('activityName', 'LIKE', '%' . $search . '%');
                })
                ->with('activities', 'layers')
                ->count();

        return response()->json([
                    'current' => (int) $current,
                    'rowCount' => (int) $rowCount,
                    'rows' => $rows,
                    'total' => $total
                        ], 200);
    }

    public function validateAudienceLayer(Request $request) {
        return AudienceRepository::validateAudienceLayer($request);
    }

    public function create() {
        $activities = \GMC\Models\Activity::lists('activityName', 'activityId')->all();
        $layers = \GMC\Models\Layer::with('questions.master')->get();
        return view('audiences.audience.create', compact('activities', 'layers'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), Audience::$rules + AudienceActivity::$rules);
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $create = Audience::create($request->all());
        foreach (\GMC\Models\Layer::all() as $l) :
            $audienceLayerResponse = [];
            foreach (\GMC\Models\Question::where('layerId', $l->layerId)->get() as $q) :
                $questionText = camel_case($q->questionText);
                if (array_key_exists($questionText, $request->all())) :
                    $audienceLayerResponse[$q->questionId] = $request->input($questionText);
                endif;
            endforeach;

            \GMC\Models\AudienceLayer::create([
                'audienceId' => $create->audienceId,
                'layerId' => $l->layerId,
                'audienceLayerResponse' => collect($audienceLayerResponse)->toJson()
            ]);
        endforeach;

        foreach ($request->activityId as $activityId) :
            \GMC\Models\AudienceActivity::create([
                'activityId' => $activityId,
                'audienceId' => $create->audienceId
            ]);
        endforeach;

        return response()->json(['create' => $create], 200);
    }

    public function show($id) {
        $audience = Audience::with('layers.questions.master', 'activities')->find($id);
        return view('audiences.audience.show', compact('audience'));
    }

    public function edit($id) {
        $activities = \GMC\Models\Activity::lists('activityName', 'activityId')->all();
        $audience = Audience::with('layers.questions.master', 'activities')->find($id);
        return view('audiences.audience.edit', compact('activities', 'audience'));
    }

    public function update(Request $request, $id) {
        $audience = Audience::find($id);
        $validator = Validator::make($request->all(), Audience::$rules + AudienceActivity::$rules);

        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $update = $audience->update($request->all());
        \GMC\Models\AudienceLayer::where('audienceId', $audience->audienceId)->delete();
        \GMC\Models\AudienceActivity::where('audienceId', $audience->audienceId)->delete();

        foreach (\GMC\Models\Layer::all() as $l) :
            $audienceLayerResponse = [];
            foreach (\GMC\Models\Question::where('layerId', $l->layerId)->get() as $q) :
                $questionText = camel_case($q->questionText);
                if (array_key_exists($questionText, $request->all())) :
                    $audienceLayerResponse[$q->questionId] = $request->input($questionText);
                endif;
            endforeach;

            \GMC\Models\AudienceLayer::create([
                'audienceId' => $audience->audienceId,
                'layerId' => $l->layerId,
                'audienceLayerResponse' => collect($audienceLayerResponse)->toJson()
            ]);
        endforeach;

        foreach ($request->activityId as $activityId) :
            \GMC\Models\AudienceActivity::create([
                'activityId' => $activityId,
                'audienceId' => $audience->audienceId
            ]);
        endforeach;

        return response()->json(['update' => $update], 200);
    }

    public function destroy($id) {
        //
    }

}
