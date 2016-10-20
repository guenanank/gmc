<?php

namespace GMC\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Models\Education as Educations;

class Education extends Controller {

    public function index() {
        return view('vendor.materialAdmin.masters.education.index');
    }

    public function bootgrid(Request $request) {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'educationId';
        $sortType = 'DESC';

        if (is_array($request->input('sort'))) :
            foreach ($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        $rows = Educations::where('educationName', 'like', '%' . $search . '%')
                ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                ->get();

        $total = Educations::where('educationName', 'like', '%' . $search . '%')
                ->count();

        return response()->json([
                    'current' => (int) $current,
                    'rowCount' => (int) $rowCount,
                    'rows' => $rows,
                    'total' => $total
                        ], 200);
    }

    public function create() {
        return view('vendor.materialAdmin.masters.education.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), Educations::rules());
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $create = Educations::create($request->all());
        return response()->json(['create' => $create], 200);
    }

    public function edit($id) {
        $education = Educations::findOrFail($id);
        return view('vendor.materialAdmin.masters.education.edit', compact('education'));
    }

    public function update(Request $request, $id) {
        $education = Educations::findOrFail($id);
        Educations::rules(['educationName' => 'required|string|max:127|unique:education,educationName,' . $education->educationId . ',educationId']);
        $validator = Validator::make($request->all(), Educations::rules());
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $update = $education->update($request->all());
        return response()->json(['update' => $update], 200);
    }

    public function destroy($id) {
        $education = Educations::findOrFail($id);
        $delete = $education->delete();
        return response()->json($delete, 200);
    }

}
