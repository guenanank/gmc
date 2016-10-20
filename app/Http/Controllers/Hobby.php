<?php

namespace GMC\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Models\Hobby as Hobbies;

class Hobby extends Controller {

    public function index() {
        return view('vendor.materialAdmin.masters.hobby.index');
    }

    public function bootgrid(Request $request) {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'hobbyId';
        $sortType = 'DESC';

        if (is_array($request->input('sort'))) :
            foreach ($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        $rows = Hobbies::where('hobbyName', 'like', '%' . $search . '%')
                ->orWhereHas('parent', function($query) use ($search) {
                    $query->where('hobbyName', 'LIKE', '%' . $search . '%');
                })->with('parent')
                ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                ->get();

        $total = Hobbies::where('hobbyName', 'like', '%' . $search . '%')
                ->orWhereHas('parent', function($query) use ($search) {
                    $query->where('hobbyName', 'LIKE', '%' . $search . '%');
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
        $hobbies = Hobbies::lists('hobbyName', 'hobbyId')->all();
        return view('vendor.materialAdmin.masters.hobby.create', compact('hobbies'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), Hobbies::rules());
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $create = Hobbies::create($request->all());
        return response()->json(['create' => $create], 200);
    }

    public function edit($id) {
        $hobby = Hobbies::findOrFail($id);
        $hobbies = Hobbies::lists('hobbyName', 'hobbyId')->all();
        return view('vendor.materialAdmin.masters.hobby.edit', compact('hobby', 'hobbies'));
    }

    public function update(Request $request, $id) {
        $hobby = Hobbies::findOrFail($id);
        Hobbies::rules(['hobbyName' => 'required|string|max:127|unique:hobbies,hobbyName,' . $hobby->hobbyId . ',hobbyId']);
        $validator = Validator::make($request->all(), Hobbies::$rules);
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $update = $hobby->update($request->all());
        return response()->json(['update' => $update], 200);
    }

    public function destroy($id) {
        $hobby = Hobbies::findOrFail($id);
        $delete = $hobby->delete();
        return response()->json($delete, 200);
    }

}
