<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LayerQuestion;

class LayerQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('audiences.layerQuestion.index');
    }
    
    public function bootgrid(Request $request) 
    {
        if ($request->ajax() == false)
        {
            return response()->toJson(['message' => 'SEX!'], 404);
        }
        
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'layerQuestionName';
        $sortType = 'ASC';
        
        if(is_array($request->input('sort')))
        {
            foreach($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        }
        
        $rows = LayerQuestion::where('layerQuestionName', 'like', '%' . $search . '%')
                    ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                    ->get();

        $total = LayerQuestion::where('layerQuestionName', 'like', '%' . $search . '%')
                    ->count();
        
        return response()->json([
            'current' => (int) $current,
            'rowCount' => (int) $rowCount,
            'searchPhrase' => $search,
            'rows' => $rows,
            'total' => $total
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('audiences.layerQuestion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax())
        {
            $validator = Validator::make($request->all(), [
                'layerQuestionName' => 'required|string|max:127|unique:layerQuestions',
            ]);
            
            if ($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }
            
            $create = LayerQuestion::create($request->all());
            return response()->json($create, 200);
            
        }
        
        return response()->toJson(['message' => 'SEX!'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $layerQuestion = LayerQuestion::findOrFail($id);
        return view('audiences.layerQuestion.edit', compact('layerQuestion'));
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
        if ($request->ajax())
        {
            $layerQuestion = LayerQuestion::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'layerQuestionName' => 'required|string|max:127|unique:layerQuestions,layerQuestionName,' . $layerQuestion->layerQuestionId . ',layerQuestionId',
            ]);
            
            if ($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }
            
            $layerQuestion->update($request->all());
            return response()->json($layerQuestion, 200);
            
        }
        
        return response()->toJson(['message' => 'SEX!'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $layerQuestion = LayerQuestion::findOrFail($id);
        $layerQuestion->delete();
        return response()->json($layerQuestion);
    }
}
