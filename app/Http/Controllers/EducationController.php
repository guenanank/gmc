<?php

namespace GMC\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Models\Education;

class EducationController extends Controller {

    public function index() {
        return view('masters.education.index');
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

        $rows = Education::where('educationName', 'like', '%' . $search . '%')
                ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                ->get();

        $total = Education::where('educationName', 'like', '%' . $search . '%')
                ->count();

        return response()->json([
                    'current' => (int) $current,
                    'rowCount' => (int) $rowCount,
                    'rows' => $rows,
                    'total' => $total
                        ], 200);
    }

    public function create() {
        return view('masters.education.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), Education::$rules);
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $create = Education::create($request->all());
        return response()->json(['create' => $create], 200);
    }

    public function edit($id) {
        $education = Education::findOrFail($id);
        return view('masters.education.edit', compact('education'));
    }

    public function update(Request $request, $id) {
        $education = Education::findOrFail($id);
        Education::$rules['educationName'] = 'required|string|max:127|unique:education,educationName,' . $education->educationId . ',educationId';
        $validator = Validator::make($request->all(), Education::$rules);
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $update = $education->update($request->all());
        return response()->json(['update' => $update], 200);
    }

    public function destroy($id) {
        $education = Education::findOrFail($id);
        $delete = $education->delete();
        return response()->json($delete, 200);
    }

}
