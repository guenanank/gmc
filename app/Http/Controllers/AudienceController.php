<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Facades\AudienceRepository;
use Validator;
use App\Layer;
use App\Audience;
use App\Question;
use App\AudienceActivity;
use App\AudienceLayer;

class AudienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('audiences.audience.index');
    }
    
    public function bootgrid(Request $request)
    {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'audienceId';
        $sortType = 'DESC';

        if(is_array($request->input('sort'))) :
            foreach($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        $rows = Audience::where('audienceId', 'LIKE', '%' . $search . '%')
                ->orWhereHas('activities', function($query) use($search) {
                    $query->where('activityName', 'LIKE', '%' . $search . '%');
                })
                ->with('activities', 'layers')
                ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                ->get();

        $total = Audience::where('audienceId', 'LIKE', '%' . $search . '%')
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
        
    public function validateAudienceLayer(Request $request)
    {
        $validator = Validator::make($request->all(), AudienceRepository::validationRules($request->layerId));
        $response = $validator->fails() ? $validator->errors() : $request;
        return response()->json($response, $validator->fails() ? 422 : 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $layer = Layer::with('question.master')->get();
        return view('audiences.audience.create', compact('layer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Audience::$rules + AudienceActivity::$rules);
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $create = Audience::create($request->all());
        foreach(Layer::all() as $l) :
            $audienceLayerResponse = [];
            foreach(Question::where('layerId', $l->layerId)->get() as $q) :
                $questionText = camel_case($q->questionText);
                if(array_key_exists($questionText, $request->all())) :
                    $audienceLayerResponse[$q->questionId] = $request->input($questionText);
                endif;
            endforeach;

            AudienceLayer::create([
                'audienceId' => $create->audienceId,
                'layerId' => $l->layerId,
                'audienceLayerResponse' => collect($audienceLayerResponse)->toJson()
            ]);
        endforeach;

        foreach($request->activityId as $activityId) :
            AudienceActivity::create([
                'activityId' => $activityId,
                'audienceId' => $create->audienceId
            ]);
        endforeach;

        return response()->json(['create' => $create], 200);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $audience = Audience::with('layers.question.master', 'activities')->find($id);
        return view('audiences.audience.show', compact('audience'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $audience = Audience::with('layers.question.master', 'activities')->find($id);
        return view('audiences.audience.edit', compact('audience'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $audience = Audience::find($id);
        $validator = Validator::make($request->all(), Audience::$rules + AudienceActivity::$rules);

        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $update = $audience->update($request->all());
        AudienceLayer::where('audienceId', $audience->audienceId)->delete();
        AudienceActivity::where('audienceId', $audience->audienceId)->delete();

        foreach(Layer::all() as $l) :
            $audienceLayerResponse = [];
            foreach(Question::where('layerId', $l->layerId)->get() as $q) :
                $questionText = camel_case($q->questionText);
                if(array_key_exists($questionText, $request->all())) :
                    $audienceLayerResponse[$q->questionId] = $request->input($questionText);
                endif;
            endforeach;

            AudienceLayer::create([
                'audienceId' => $audience->audienceId,
                'layerId' => $l->layerId,
                'audienceLayerResponse' => collect($audienceLayerResponse)->toJson()
            ]);
        endforeach;

        foreach($request->activityId as $activityId) :
            AudienceActivity::create([
                'activityId' => $activityId,
                'audienceId' => $audience->audienceId
            ]);
        endforeach;

        return response()->json(['update' => $update], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
