<?php

namespace GMC\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Layer;
use GMC\Question;

class LayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('audiences.layerQuestion.layer.index');
    }
    
    public function layer($layerId)
    {
        $layer = Layer::findOrFail($layerId);
        $questionType = Question::$questionType;
        $formType = Question::$questionFormType;
        return view('audiences.layerQuestion.question.index', compact('layer', 'questionType', 'formType'));
    }
    
    public function bootgrid(Request $request) 
    {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'layerId';
        $sortType = 'DESC';

        if(is_array($request->input('sort'))) :
            foreach ($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        $rows = Layer::where('layerName', 'LIKE', '%' . $search . '%')
                    ->orWhere('layerDesc', 'LIKE', '%' . $search . '%')
                    ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)->get();

        $total = Layer::where('layerName', 'LIKE', '%' . $search . '%')
                    ->orWhere('layerDesc', 'LIKE', '%' . $search . '%')
                    ->count();

        return response()->json([
            'current' => (int) $current,
            'rowCount' => (int) $rowCount,
            'rows' => $rows,
            'total' => $total
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('audiences.layerQuestion.layer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Layer::$rules);
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $create = Layer::create($request->all());
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
        $layer = Layer::findOrFail($id);
        return view('audiences.layerQuestion.layer.edit', compact('layer'));
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
        $layer = Layer::findOrFail($id);
        Layer::$rules['layerName'] = 'required|string|max:127|unique:layers,layerName,' . $layer->layerId . ',layerId';
        $validator = Validator::make($request->all(), Layer::$rules);
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $update = $layer->update($request->all());
        return response()->json(['update' => $update], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $layer = Layer::findOrFail($id);
        $delete = $layer->delete();
        return response()->json($delete, 200);
    }
    
}
