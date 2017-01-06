<?php

namespace GMC\Http\Controllers\Masters;

use Validator;
use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Models\Interest as Interests;

class Interest extends \GMC\Http\Controllers\Controller {

    public function index() {
        return view('vendor.materialAdmin.masters.interest.index');
    }

    public function bootgrid(Request $request) {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'interestId';
        $sortType = 'DESC';

        if (is_array($request->input('sort'))) :
            foreach ($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        if (empty($search)) :
            $rows = Interests::with('parent')->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)->get();
            $total = Interests::count();
        else:
            $rows = Interests::where('interestName', 'like', '%' . $search . '%')
                    ->orWhereHas('parent', function($query) use ($search) {
                        $query->where('interestName', 'LIKE', '%' . $search . '%');
                    })->with('parent')
                    ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                    ->get();

            $total = Interests::where('interestName', 'like', '%' . $search . '%')
                    ->orWhereHas('parent', function($query) use ($search) {
                        $query->where('interestName', 'LIKE', '%' . $search . '%');
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
        $interests = Interests::lists();
        return view('vendor.materialAdmin.masters.interest.create', compact('interests'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), Interests::rules());
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $create = Interests::create($request->all());
        return response()->json(['create' => $create], 200);
    }

    public function edit($id) {
        $interest = Interests::findOrFail($id);
        $interests = Interests::lists();
        return view('vendor.materialAdmin.masters.interest.edit', compact('interest', 'interests'));
    }

    public function update(Request $request, $id) {
        $interest = Interests::findOrFail($id);
        Interests::rules(['interestName' => 'required|string|max:127|unique:interests,interestName,' . $interest->interestId . ',interestId']);
        $validator = Validator::make($request->all(), Interests::$rules);
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $update = $interest->update($request->all());
        return response()->json(['update' => $update], 200);
    }

    public function destroy($id) {
        $interest = Interests::findOrFail($id);
        $delete = $interest->delete();
        return response()->json($delete, 200);
    }

}
