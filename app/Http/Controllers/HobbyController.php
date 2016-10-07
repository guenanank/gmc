<?php

namespace GMC\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Models\Hobby;

class HobbyController extends Controller {

    public function index() {
        return view('masters.hobby.index');
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

        $rows = Hobby::where('hobbyName', 'like', '%' . $search . '%')
                ->orWhereHas('parent', function($query) use ($search) {
                    $query->where('hobbyName', 'LIKE', '%' . $search . '%');
                })->with('parent')
                ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                ->get();

        $total = Hobby::where('hobbyName', 'like', '%' . $search . '%')
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
        $hobbies = Hobby::lists('hobbyName', 'hobbyId')->all();
        return view('masters.hobby.create', compact('hobbies'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), Hobby::$rules);
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $create = Hobby::create($request->all());
        return response()->json(['create' => $create], 200);
    }

    public function edit($id) {
        $hobby = Hobby::findOrFail($id);
        $hobbies = Hobby::lists('hobbyName', 'hobbyId')->all();
        return view('masters.hobby.edit', compact('hobby', 'hobbies'));
    }

    public function update(Request $request, $id) {
        $hobby = Hobby::findOrFail($id);
        Hobby::$rules['hobbyName'] = 'required|string|max:127|unique:hobbies,hobbyName,' . $hobby->hobbyId . ',hobbyId';
        $validator = Validator::make($request->all(), Hobby::$rules);
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $update = $hobby->update($request->all());
        return response()->json(['update' => $update], 200);
    }

    public function destroy($id) {
        $hobby = Hobby::findOrFail($id);
        $delete = $hobby->delete();
        return response()->json($delete, 200);
    }

}
