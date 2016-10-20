<?php

namespace GMC\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Models\MediaGroup as MediaGroups;

class MediaGroup extends Controller {

    public function index() {
        return view('vendor.materialAdmin.masters.mediaGroup.index');
    }

    public function bootgrid(Request $request) {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'mediaGroupId';
        $sortType = 'DESC';

        if (is_array($request->input('sort'))) :
            foreach ($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        $rows = MediaGroups::where('mediaGroupName', 'like', '%' . $search . '%')
                ->orWhereHas('parent', function($query) use ($search) {
                    $query->where('mediaGroupName', 'LIKE', '%' . $search . '%');
                })->with('parent')
                ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                ->get();

        $total = MediaGroups::where('mediaGroupName', 'like', '%' . $search . '%')
                ->orWhereHas('parent', function($query) use ($search) {
                    $query->where('mediaGroupName', 'LIKE', '%' . $search . '%');
                })->with('parent')
                ->count();

        return response()->json([
                    'current' => (int) $current,
                    'rowCount' => (int) $rowCount,
                    'rows' => $rows,
                    'total' => $total
                        ], 200);
    }

    public function create() {
        $mediaGroups = MediaGroups::lists('mediaGroupName', 'mediaGroupId')->all();
        return view('vendor.materialAdmin.masters.mediaGroup.create', compact('mediaGroups'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), MediaGroups::rules());
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $create = MediaGroups::create($request->all());
        return response()->json(['create' => $create], 200);
    }

    public function edit($id) {
        $mediaGroup = MediaGroups::findOrFail($id);
        $mediaGroups = MediaGroups::lists('mediaGroupName', 'mediaGroupId')->all();
        return view('vendor.materialAdmin.masters.mediaGroup.edit', compact('mediaGroup', 'mediaGroups'));
    }

    public function update(Request $request, $id) {
        $mediaGroup = MediaGroups::findOrFail($id);
        MediaGroups::rules(['mediaGroupName' => 'required|string|max:127|unique:mediaGroups,mediaGroupName,' . $mediaGroup->mediaGroupId . ',mediaGroupId']);
        $validator = Validator::make($request->all(), MediaGroups::rules());
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $update = $mediaGroup->update($request->all());
        return response()->json(['update' => $update], 200);
    }

    public function destroy($id) {
        $mediaGroup = MediaGroups::findOrFail($id);
        $delete = $mediaGroup->delete();
        return response()->json($delete, 200);
    }

}
