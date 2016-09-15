<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Question;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['message' => 'SEX!'], 404);
    }
    
    public function bootgrid(Request $request)
    {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'questionId';
        $sortType = 'DESC';

        if(is_array($request->input('sort'))) :
            foreach($request->input('sort') as $key => $value) :
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        $rows = Question::where('layerId', $request->input('layer'))
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

        $total = Question::where('layerId', $request->input('layer'))
                ->where(function($query) use($search) {
                    $query->orWhere('questionType', 'LIKE', '%' . $search . '%');
                    $query->orWhere('questionText', 'LIKE', '%' . $search . '%');
                    $query->orWhere('questionAnswer', 'LIKE', '%' . $search . '%');
                    $query->orWhere('questionDesc', 'LIKE', '%' . $search . '%');
                    $query->orWhereHas('master', function($query) use ($search) {
                        $query->where('masterName', 'LIKE', '%' . $search . '%');
                    });
                })->with('master')
                ->count();

        return response()->json([
            'current' => (int) $current,
            'rowCount' => (int) $rowCount,
            'rows' => $rows,
            'total' => (int) $total
        ], 200);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Question::$rules['masterId'] = 'required_if:questionTypeId,useMaster|exists:masters,masterId|unique:questions,masterId,NULL,questionId,layerId,' . $request->layerId;
        $validator = Validator::make($request->all(), Question::$rules);

        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $create = Question::create($request->all());
        return response()->json(['create' => $create], 200);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {
        $formType = Question::$questionFormType;
        $question = Question::with('layer')->findOrFail($id);
        return view('audiences.layerQuestion.question.edit', compact('question', 'formType'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) 
    {
        $question = Question::findOrFail($id);
        Question::$rules['masterId'] = 'required_if:questionTypeId,useMaster|exists:masters,masterId|unique:questions,masterId,NULL,questionId,layerId,' . $question->layerId;

        if($request->has('questionIsMandatory') == false) :
            $request->merge(['questionIsMandatory' => false]);
        endif;

        $validator = Validator::make($request->all(), Question::$rules);
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $question->update($request->all());
        return response()->json($request->all(), 200);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $delete = $question->delete();
        return response()->json($delete, 200);
    }
}
