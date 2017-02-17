<?php

namespace GMC\Http\Controllers\Audiences;

use Validator;
use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Services\Facades\Audience as Audiences;

class Question extends \GMC\Http\Controllers\Controller {

    public $master;

    public function __construct(\GMC\Models\Master $master) {
        $this->master = $master;
    }

    public function bootgrid(Request $request) {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'questionSort';
        $sortType = 'ASC';

        if (is_array($request->input('sort'))) :
            foreach ($request->input('sort') as $key => $value) :
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        if (empty($search)) :
            $rows = Audiences::Question()->where('layerId', $request->input('layer'))->with('master')
                    ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                    ->get();

            $total = Audiences::Question()->where('layerId', $request->input('layer'))->count();
        else :
            $rows = Audiences::Question()->where('layerId', $request->input('layer'))
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

            $total = Audiences::Question()->where('layerId', $request->input('layer'))
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
        endif;

        return response()->json([
                    'current' => (int) $current,
                    'rowCount' => (int) $rowCount,
                    'rows' => $rows,
                    'total' => (int) $total
                        ], 200);
    }

    public function store(Request $request) {
        Audiences::Question()->rules(['masterId' => 'required_if:questionType,useMaster|exists:masters,masterId|unique:questions,masterId,NULL,questionId,layerId,' . $request->layerId]);
        $validator = Validator::make($request->all(), Audiences::Question()->rules());

        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        if ($request->input('masterId')) :
            $master = $this->master->findOrFail($request->input('masterId'));
            if ($master->masterUseAPI) :
                $subText = $master->masterFormat->where('form', true)->pluck('name');
                $request->merge(['questionSubText' => $subText->toJson()]);
            endif;
        endif;
        
        if($request->input('questionType') != 'essay') :
            $request->merge(['questionFormType' => 'select']);
        endif;

        $create = Audiences::Question()->create($request->all());
        return response()->json(['create' => $create], 200);
    }

    public function edit($id) {
        $formType = Audiences::Question()->questionFormType();
        array_pop($formType);
        $question = Audiences::Question()->with('layer')->findOrFail($id);
        $masters = $this->master->lists('masterName', 'masterId')->all();
        return view('vendor.materialAdmin.audiences.layerQuestion.question.edit', compact('question', 'formType', 'masters'));
    }

    public function update(Request $request, $id) {
        $question = Audiences::Question()->findOrFail($id);
        Audiences::Question()->rules(['masterId' => 'required_if:questionType,useMaster|exists:masters,masterId|unique:questions,masterId,NULL,questionId,layerId,' . $question->layerId]);

        if ($request->has('questionIsMandatory') == false) :
            $request->merge(['questionIsMandatory' => false]);
        endif;

        $validator = Validator::make($request->all(), Audiences::Question()->rules());
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        if ($request->input('masterId')) :
            $master = $this->master->findOrFail($request->input('masterId'));
            if ($master->masterUseAPI) :
                $subText = $master->masterFormat->where('form', true)->pluck('name');
                $request->merge(['questionSubText' => $subText->toJson()]);
            endif;
        endif;
        
        if($request->input('questionType') != 'essay') :
            $request->merge(['questionFormType' => 'select']);
        endif;

        $request->merge(['questionType' => camel_case($request->questionType)]);
        $question->update($request->all());
        return response()->json($request->all(), 200);
    }

    public function destroy($id) {
        $question = Audiences::Question()->findOrFail($id);
        $delete = $question->delete();
        return response()->json($delete, 200);
    }

}
