<?php

namespace GMC\Http\Controllers\Masters;

use Validator;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GMC\Http\Requests;
use Illuminate\Support\Facades\Hash;
use GMC\Models\Activity as Activities;
use GMC\Services\Facades\Master;

class Activity extends \GMC\Http\Controllers\Controller {

    private $client;
    private $request;
    protected $media;

    public function __construct(Request $request, Client $client) {
        $this->request = $request;
        $this->client = $client;
        $this->media = config('api.target') . '/' . config('api.version') . '/gateway/media/';
    }

    public function index() {
        return view('vendor.materialAdmin.masters.activity.index');
    }

    public function bootgrid() {
        $current = $this->request->input('current', 1);
        $rowCount = $this->request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $this->request->input('searchPhrase');
        $sortColumn = 'activityId';
        $sortType = 'DESC';

        if (is_array($this->request->input('sort'))) :
            foreach ($this->request->input('sort') as $key => $value) :
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        if (empty($search)) :
            $rows = Activities::with('source')->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)->get();
            $total = Activities::count();
        else :
            $rows = Activities::where('activityName', 'LIKE', '%' . $search . '%')
                    ->orWhere('activityWhere', 'LIKE', '%' . $search . '%')
                    ->orWhere('activityWhen', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('source', function($query) use ($search) {
                        $query->where('sourceName', 'LIKE', '%' . $search . '%');
                    })
                    ->with('source')
                    ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                    ->get();

            $total = Activities::where('activityName', 'LIKE', '%' . $search . '%')
                    ->orWhere('activityWhere', 'LIKE', '%' . $search . '%')
                    ->orWhere('activityWhen', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('source', function($query) use ($search) {
                        $query->where('sourceName', 'LIKE', '%' . $search . '%');
                    })
                    ->count();
        endif;

        return response()->json([
                    'current' => (int) $current,
                    'rowCount' => (int) $rowCount,
                    'rows' => $rows,
                    'total' => $total
                        ], 200);
    }

    public function create() {
        $sources = \GMC\Models\Source::lists('sourceName', 'sourceId')->all();
        $requestMedia = $this->client->options($this->media . 'lists', [
            'query' => ['token' => $this->request->session()->get('api_token')]
        ]);

        $media = collect(json_decode($requestMedia->getBody()))->toArray();
        return view('vendor.materialAdmin.masters.activity.create', compact('sources', 'media'));
    }

    public function store() {
        $validator = Validator::make($this->request->all(), Activities::rules());
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $this->request->merge(['activityToken' => Hash::make($this->request->activityOldName)]);
        $create = Activities::create($this->request->all());
        return response()->json(['create' => $create], 200);
    }

    public function edit($id) {
        $activity = Activities::findOrFail($id);
        $sources = \GMC\Models\Source::lists('sourceName', 'sourceId')->all();
        $requestMedia = $this->client->options($this->media . 'lists', [
            'query' => ['token' => $this->request->session()->get('api_token')]
        ]);

        $media = collect(json_decode($requestMedia->getBody()))->toArray();
        return view('vendor.materialAdmin.masters.activity.edit', compact('activity', 'sources', 'media'));
    }

    public function update(Request $request, $id) {
        $activity = Activities::findOrFail($id);
        Activities::rules(['activityName' => 'required|string|max:127|unique:activities,activityName,' . $activity->activityId . ',activityId']);
        $validator = Validator::make($this->request->all(), Activities::rules());
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $this->request->merge(['activityToken' => Hash::make($this->request->activityOldName)]);
        $update = $activity->update($this->request->all());
        return response()->json(['update' => $update], 200);
    }

    public function destroy($id) {
        $activity = Activities::findOrFail($id);
        $delete = $activity->delete();
        return response()->json($delete, 200);
    }

    public function selectpicker() {
        $return = [];
        $activities = Activities::where('activityName', 'like', '%' . $this->request->input('activityName') . '%')->get();
        foreach ($activities as $activity) :
            $return[] = [
                'value' => $activity->activityId,
                'text' => $activity->activityName
            ];
        endforeach;

        return $return;
    }

}
