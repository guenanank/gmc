<?php

namespace GMC\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Models\Question as Questions;

class Question extends Controller {

    public function bootgrid(Request $request) {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'questionId';
        $sortType = 'DESC';

        if (is_array($request->input('sort'))) :
            foreach ($request->input('sort') as $key => $value) :
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        $rows = Questions::where('layerId', $request->input('layer'))
                ->where(function($query) use($search) {
                    $query->orWhere('questionType', 'LIKE', '%' . $search . '%');
                    $query->orWhere('questionText', 'LIKE', '%' . $search . '%');
                    $query->orWhere('questionAnswer', 'LIKE', '%' . $search . '%');
                    $query->orWhere('questionDesc', 'LIKE', '%' . $search . '%');
                    $query->orWhereHas('master', function($query) use ($search) {
                        $query->where('masterName', 'LIKE', '%' . $search . '%');
                    });
                })->with('master')
                ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                ->get();

        $total = Questions::where('layerId', $request->input('layer'))
                ->where(function($query) use($search) {
                    $query->orWhere('questionType', 'LIKE', '%' . $search . '%');
                    $query->orWhere('questionText', 'LIKE', '%' . $search . '%');
                    $query->orWhere('questionAnswer', 'LIKE', '%' . $search . '%');
                    $query->orWhere('questionDesc', 'LIKE', '%' . $search . '%');
                    $query->orWhereHas('master', function($query) use ($search) {
                        $query->where('masterName', 'LIKE', '%' . $search . '%');
                    });
                })
                ->count();

        return response()->json([
                    'current' => (int) $current,
                    'rowCount' => (int) $rowCount,
                    'rows' => $rows,
                    'total' => (int) $total
                        ], 200);
    }

    public function store(Request $request) {
        Questions::rules(['masterId' => 'required_if:questionTypeId,useMaster|exists:masters,masterId|unique:questions,masterId,NULL,questionId,layerId,' . $request->layerId]);
        $validator = Validator::make($request->all(), Questions::rules());

        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $create = Questions::create($request->all());
        return response()->json(['create' => $create], 200);
    }

    public function edit($id) {
        $formType = Questions::questionFormType();
        $question = Questions::with('layer')->findOrFail($id);
        $masters = \GMC\Models\Master::lists('masterName', 'masterId')->all();
        return view('audiences.layerQuestion.question.edit', compact('question', 'formType', 'masters'));
    }

    public function update(Request $request, $id) {
        $question = Questions::findOrFail($id);
        Questions::rules(['masterId' => 'required_if:questionTypeId,useMaster|exists:masters,masterId|unique:questions,masterId,NULL,questionId,layerId,' . $question->layerId]);

        if ($request->has('questionIsMandatory') == false) :
            $request->merge(['questionIsMandatory' => false]);
        endif;

        $validator = Validator::make($request->all(), Questions::rules());
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $request->merge(['questionType' => camel_case($request->questionType)]);
        $question->update($request->all());
        return response()->json($request->all(), 200);
    }

    public function destroy($id) {
        $question = Questions::findOrFail($id);
        $delete = $question->delete();
        return response()->json($delete, 200);
    }

}
