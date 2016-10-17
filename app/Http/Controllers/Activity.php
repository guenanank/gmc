<?php

namespace GMC\Http\Controllers;

use Crypt;
use Validator;
use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Models\Activity as Activities;

class Activity extends Controller {

    public function index() {
        return view('masters.activity.index');
    }

    public function bootgrid(Request $request) {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'activityId';
        $sortType = 'DESC';

        if (is_array($request->input('sort'))) :
            foreach ($request->input('sort') as $key => $value) :
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        $rows = Activities::where('activityName', 'LIKE', '%' . $search . '%')
                ->orWhere('activityWhere', 'LIKE', '%' . $search . '%')
                ->orWhere('activityWhen', 'LIKE', '%' . $search . '%')
                ->orWhereHas('source', function($query) use ($search) {
                    $query->where('sourceName', 'LIKE', '%' . $search . '%');
                })
                ->orWhereHas('mediaGroup', function($query) use ($search) {
                    $query->where('mediaGroupName', 'LIKE', '%' . $search . '%');
                })
                ->with('source', 'mediaGroup')
                ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                ->get();

        $total = Activities::where('activityName', 'LIKE', '%' . $search . '%')
                ->orWhere('activityWhere', 'LIKE', '%' . $search . '%')
                ->orWhere('activityWhen', 'LIKE', '%' . $search . '%')
                ->orWhereHas('source', function($query) use ($search) {
                    $query->where('sourceName', 'LIKE', '%' . $search . '%');
                })
                ->orWhereHas('mediaGroup', function($query) use ($search) {
                    $query->where('mediaGroupName', 'LIKE', '%' . $search . '%');
                })
                ->count();

        return response()->json([
                    'current' => (int) $current,
                    'rowCount' => (int) $rowCount,
                    'rows' => $rows,
                    'total' => $total
                        ], 200);
    }

    public function create() {
        $sources = \GMC\Models\Source::lists('sourceName', 'sourceId')->all();
        $mediaGroups = \GMC\Models\MediaGroup::lists('mediaGroupName', 'mediaGroupId')->all();
        return view('masters.activity.create', compact('sources', 'mediaGroups'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), Activities::rules());
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $request->merge(['activityToken' => substr(Crypt::encrypt($request->activityName), 15, -1)]);
        $create = Activities::create($request->all());
        return response()->json(['create' => $create], 200);
    }

    public function edit($id) {
        $activity = Activities::findOrFail($id);
        $sources = \GMC\Models\Source::lists('sourceName', 'sourceId')->all();
        $mediaGroups = \GMC\Models\MediaGroup::lists('mediaGroupName', 'mediaGroupId')->all();
        return view('masters.activity.edit', compact('activity', 'sources', 'mediaGroups'));
    }

    public function update(Request $request, $id) {
        $activity = Activities::findOrFail($id);
        Activities::rules(['activityName' => 'required|string|max:127|unique:activities,activityName,' . $activity->activityId . ',activityId']);
        $validator = Validator::make($request->all(), Activities::rules());
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $request->merge(['activityToken' => substr(Crypt::encrypt($request->activityName), 15, -1)]);
        $update = $activity->update($request->all());
        return response()->json(['update' => $update], 200);
    }

    public function destroy($id) {
        $activity = Activities::findOrFail($id);
        $delete = $activity->delete();
        return response()->json($delete, 200);
    }

}
