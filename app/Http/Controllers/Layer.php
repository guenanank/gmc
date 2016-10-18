<?php

namespace GMC\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Services\Facades\Audience as Audiences;

class Layer extends Controller {

    public function index() {
        return view('audiences.layerQuestion.layer.index');
    }

    public function layer($layerId) {
        $layer = Audiences::Layer()->findOrFail($layerId);
        $questionType = Audiences::Question()->questionType();
        $formType = Audiences::Question()->questionFormType();
        $masters = \GMC\Models\Master::lists('masterName', 'masterId')->all();
        return view('audiences.layerQuestion.question.index', compact('layer', 'masters', 'questionType', 'formType'));
    }

    public function bootgrid(Request $request) {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'layerId';
        $sortType = 'DESC';

        if (is_array($request->input('sort'))) :
            foreach ($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        $rows = Audiences::Layer()->where('layerName', 'LIKE', '%' . $search . '%')
                        ->orWhere('layerDesc', 'LIKE', '%' . $search . '%')
                        ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)->get();

        $total = Audiences::Layer()->where('layerName', 'LIKE', '%' . $search . '%')
                ->orWhere('layerDesc', 'LIKE', '%' . $search . '%')
                ->count();

        return response()->json([
                    'current' => (int) $current,
                    'rowCount' => (int) $rowCount,
                    'rows' => $rows,
                    'total' => $total
                        ], 200);
    }

    public function create() {
        return view('audiences.layerQuestion.layer.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), Audiences::Layer()->rules());
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $create = Audiences::Layer()->create($request->all());
        return response()->json(['create' => $create], 200);
    }

    public function edit($id) {
        $layer = Audiences::Layer()->findOrFail($id);
        return view('audiences.layerQuestion.layer.edit', compact('layer'));
    }

    public function update(Request $request, $id) {
        $layer = Audiences::Layer()->findOrFail($id);
        Audiences::Layer()->rules(['layerName' => 'required|string|max:127|unique:layers,layerName,' . $layer->layerId . ',layerId']);
        $validator = Validator::make($request->all(), Audiences::Layer()->rules());
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $update = $layer->update($request->all());
        return response()->json(['update' => $update], 200);
    }

    public function destroy($id) {
        $layer = Audiences::Layer()->findOrFail($id);
        $delete = $layer->delete();
        return response()->json($delete, 200);
    }

}
