<?php

namespace GMC\Http\Controllers\Audiences;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GMC\Http\Controllers\Controller;
use GMC\Services\Facades\Audience as Audiences;
use Validator;

class Audience extends \GMC\Http\Controllers\Controller {

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

    public function validateAudienceLayer() {
        return Audiences::validateAudienceLayer($this->request);
    }

    public function create() {
        $token = $this->token;
        $api = $this->api;
        $client = $this->client;
        $activities = Audiences::Activity()->lists('activityName', 'activityId')->all();
        $layers = Audiences::Layer()->with(['questions.master' => function($query) {
            $query->orderBy('questionSort', 'asc');
        }])->get();
        return view('vendor.materialAdmin.audiences.audience.create', compact('token', 'api', 'client', 'activities', 'layers'));
    }

    public function store() {
        $validator = Validator::make($this->request->all(), Audiences::Audience()->rules() + Audiences::AudienceActivity()->rules());
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $create = Audiences::Audience()->create($this->request->all());
        foreach ($this->request->activityId as $activityId) :
            $audienceActivity = [
                'activityId' => $activityId,
                'audienceId' => $create->audienceId
            ];
        endforeach;
        Audiences::AudienceActivity()->insert($audienceActivity);

        $this->audienceLayerResponse($create->audienceId);
        return response()->json(['create' => $create], 200);
    }

    public function show($id) {
        $audience = Audiences::Audience()->with('layers.questions.master', 'activities')->find($id);
        return view('vendor.materialAdmin.audiences.audience.show', compact('audience'));
    }

    public function edit($id) {
        $token = $this->token;
        $api = $this->api;
        $client = $this->client;
        $activities = Audiences::Activity()->lists('activityName', 'activityId')->all();
        $layers = Audiences::Layer()->with('questions.master')->get();
        $audience = Audiences::Audience()->with('audienceLayers', 'audienceActivities')->find($id);
        return view('vendor.materialAdmin.audiences.audience.edit', compact('token', 'api', 'client', 'activities', 'audience', 'layers'));
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

        $audienceActivity = [];
        foreach ($request->activityId as $activityId) :
            $audienceActivity = [
                'activityId' => $activityId,
                'audienceId' => $audience->audienceId
            ];
        endforeach;
        Audiences::AudienceActivity()->insert($audienceActivity);
        $this->audienceLayerResponse($audience->audienceId);
        return response()->json(['update' => $update], 200);
    }

    public function destroy($id) {
        //
    }

    private function audienceLayerResponse($audienceId) {
        foreach (Audiences::Layer()->select('layerId')->with('questions.master')->get() as $l) :
            $audienceLayerResponse = collect([]);
            foreach ($l->questions as $q) :
                if (is_null($q->master) == false && $q->master->masterUseAPI) :
                    $questionSubText = [];
                    foreach ($q->questionSubText as $row) :
                        if ($q->master->masterFormat->where('name', $row)->first()->form) :
                            $questionSubText[$row] = $this->request->input($row);
                        endif;
                    endforeach;
                    $audienceLayerResponse->put($q->questionId, $questionSubText);
                else :
                    $questionText = camel_case(str_singular($q->questionText));
                    if (array_key_exists($questionText, $this->request->all())) :
                        $audienceLayerResponse->put($q->questionId, $this->request->input($questionText));
                    endif;
                endif;
            endforeach;

            Audiences::AudienceLayer()->create([
                'audienceId' => $audienceId,
                'layerId' => $l->layerId,
                'audienceLayerResponse' => $audienceLayerResponse->toJson()
            ]);

        endforeach;
    }

}
