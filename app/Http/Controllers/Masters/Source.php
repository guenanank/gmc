<?php

namespace GMC\Http\Controllers\Masters;

use Validator;
use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Models\Source as Sources;

class Source extends \GMC\Http\Controllers\Controller {

    public function index() {
        return view('vendor.materialAdmin.masters.source.index');
    }

    public function bootgrid(Request $request) {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'sourceId';
        $sortType = 'DESC';

        if (is_array($request->input('sort'))) :
            foreach ($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        if (empty($search)) :
            $rows = Sources::skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)->get();
            $total = Sources::count();
        else :
            $rows = Sources::where('sourceName', 'like', '%' . $search . '%')
                    ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                    ->get();

            $total = Sources::where('sourceName', 'like', '%' . $search . '%')
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
        $sourceTypes = Sources::sourceTypes();
        return view('vendor.materialAdmin.masters.source.create', compact('sourceTypes'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), Sources::rules([], $request->sourceType));
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $create = Sources::create($request->all());
        return response()->json(['create' => $create], 200);
    }

    public function edit($id) {
        $source = Sources::findOrFail($id);
        $sourceTypes = Sources::sourceTypes();
        return view('vendor.materialAdmin.masters.source.edit', compact('source', 'sourceTypes'));
    }

    public function update(Request $request, $id) {
        $source = Sources::findOrFail($id);
        $validator = Validator::make($request->all(), Sources::rules([], $request->sourceType));
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $update = $source->update($request->all());
        return response()->json(['update' => $update], 200);
    }

    public function destroy($id) {
        $source = Sources::findOrFail($id);
        $delete = $source->delete();
        return response()->json($delete, 200);
    }

}
