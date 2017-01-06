<?php

namespace GMC\Http\Controllers\Masters;

use Validator;
use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Models\Profession as Professions;

class Profession extends \GMC\Http\Controllers\Controller {

    public function index() {
        return view('vendor.materialAdmin.masters.profession.index');
    }

    public function bootgrid(Request $request) {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'professionId';
        $sortType = 'DESC';

        if (is_array($request->input('sort'))) :
            foreach ($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        if (empty($search)) :
            $rows = Professions::with('parent')->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)->get();
            $total = Professions::count();
        else :
            $rows = Professions::where('professionName', 'like', '%' . $search . '%')
                    ->orWhereHas('parent', function($query) use ($search) {
                        $query->where('professionName', 'LIKE', '%' . $search . '%');
                    })->with('parent')
                    ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                    ->get();

            $total = Professions::where('professionName', 'like', '%' . $search . '%')
                    ->orWhereHas('parent', function($query) use ($search) {
                        $query->where('professionName', 'LIKE', '%' . $search . '%');
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
        $professions = Professions::lists();
        return view('vendor.materialAdmin.masters.profession.create', compact('professions'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), Professions::rules());
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $create = Professions::create($request->all());
        return response()->json(['create' => $create], 200);
    }

    public function edit($id) {
        $profession = Professions::findOrFail($id);
        $professions = Professions::lists();
        return view('vendor.materialAdmin.masters.profession.edit', compact('profession', 'professions'));
    }

    public function update(Request $request, $id) {
        $profession = Professions::findOrFail($id);
        Professions::rules(['professionName' => 'required|string|max:127|unique:professions,professionName,' . $profession->professionId . ',professionId']);
        $validator = Validator::make($request->all(), Professions::rules());
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $update = $profession->update($request->all());
        return response()->json(['update' => $update], 200);
    }

    public function destroy($id) {
        $profession = Professions::findOrFail($id);
        $delete = $profession->delete();
        return response()->json($delete, 200);
    }

}
