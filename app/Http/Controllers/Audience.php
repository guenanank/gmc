<?php

namespace GMC\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GMC\Http\Controllers\Controller;
use GMC\Services\Facades\Audience as Audiences;
use Validator;

class Audience extends Controller {

    private $request;
    protected $master;
    protected $client;
    protected $api;
    protected $token;

    public function __construct(Request $request, Client $client) {
        $this->request = $request;
        $this->api = config('api.target') . '/' . config('api.version') . '/';
        $this->token = $this->request->session()->get('api_token');
        $this->client = $client;
    }

    public function index() {
        return view('vendor.materialAdmin.audiences.audience.index');
    }

    public function bootgrid() {
        $current = $this->request->input('current', 1);
        $rowCount = $this->request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $this->request->input('searchPhrase');
        $sortColumn = 'audienceId';
        $sortType = 'DESC';

        if (is_array($this->request->input('sort'))) :
            foreach ($this->request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        $rows = Audiences::Audience()->where('audienceId', 'LIKE', '%' . $search . '%')
                ->orWhereHas('activities', function($query) use($search) {
                    $query->where('activityName', 'LIKE', '%' . $search . '%');
                })
                ->with('activities', 'layers')
                ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                ->get();

        $total = Audiences::Audience()->where('audienceId', 'LIKE', '%' . $search . '%')
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
        return Audiences::validateAudienceLayer($request);
    }

    public function create() {
        $token = $this->token;
        $api = $this->api;
        $client = $this->client;
        $activities = Audiences::Activity()->lists('activityName', 'activityId')->all();
        $layers = Audiences::Layer()->with('questions.master')->get();
        return view('vendor.materialAdmin.audiences.audience.create', compact('token', 'api', 'client', 'activities', 'layers'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), Audiences::Audience()->rules() + Audiences::AudienceActivity()->rules());
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $create = Audiences::Audience()->create($request->all());
        foreach (Audiences::Layer()->select('layerId')->get() as $l) :
            dd($l);
            $audienceLayerResponse = [];
            foreach (Audiences::Question()->where('layerId', $l->layerId)->get() as $q) :
                $questionText = camel_case($q->questionText);
                if (array_key_exists($questionText, $request->all())) :
                    $audienceLayerResponse[$q->questionId] = $request->input($questionText);
                endif;
            endforeach;

            Audiences::Layer()->create([
                'audienceId' => $create->audienceId,
                'layerId' => $l->layerId,
                'audienceLayerResponse' => collect($audienceLayerResponse)->toJson()
            ]);
        endforeach;

        foreach ($request->activityId as $activityId) :
            Audiences::AudienceActivity()->create([
                'activityId' => $activityId,
                'audienceId' => $create->audienceId
            ]);
        endforeach;

        return response()->json(['create' => $create], 200);
    }

    public function show($id) {
        $audience = Audiences::Audience()->with('layers.questions.master', 'activities')->find($id);
        return view('vendor.materialAdmin.audiences.audience.show', compact('audience'));
    }

    public function edit($id) {
        $activities = Audiences::Activity()->lists('activityName', 'activityId')->all();
        $audience = Audiences::Audience()->with('layers.questions.master', 'activities')->find($id);
        return view('vendor.materialAdmin.audiences.audience.edit', compact('activities', 'audience'));
    }

    public function update(Request $request, $id) {
        $audience = Audiences::Audience()->find($id);
        $validator = Validator::make($request->all(), Audiences::Audience()->rules() + Audiences::AudienceActivity()->rules());

        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $update = $audience->update($request->all());
        Audiences::AudienceLayer()->where('audienceId', $audience->audienceId)->delete();
        Audiences::Activity()->where('audienceId', $audience->audienceId)->delete();

        foreach (Audiences::Layer()->select('layerId')->all() as $l) :
            $audienceLayerResponse = [];
            foreach (Audiences::Question()->where('layerId', $l->layerId)->get() as $q) :
                $questionText = camel_case($q->questionText);
                if (array_key_exists($questionText, $request->all())) :
                    $audienceLayerResponse[$q->questionId] = $request->input($questionText);
                endif;
            endforeach;

            Audiences::AudienceLayer()->create([
                'audienceId' => $audience->audienceId,
                'layerId' => $l->layerId,
                'audienceLayerResponse' => collect($audienceLayerResponse)->toJson()
            ]);
        endforeach;

        foreach ($request->activityId as $activityId) :
            Audiences::AudienceActivity()->create([
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
