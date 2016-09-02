<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Audience;
use App\Layer;
use App\Question;
use App\AudienceActivity;
use App\AudienceLayer;

class AudienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('audiences.audience.index');
    }
    
    public function bootgrid(Request $request)
    {
        if ($request->ajax()) :
            $current = $request->input('current', 1);
            $rowCount = $request->input('rowCount', 10);
            $skip = $current ? ($current - 1) * $rowCount : 0;
            $search = $request->input('searchPhrase');
            $sortColumn = 'audienceId';
            $sortType = 'DESC';

            if(is_array($request->input('sort')))
            {
                foreach($request->input('sort') as $key => $value):
                    $sortColumn = $key;
                    $sortType = $value;
                endforeach;
            }

            $rows = Audience::whereHas('activities', function($query) use($search) {
                        $query->where('activityName', 'LIKE', '%' . $search . '%');
                    })
                    ->with('activities', 'layers')
                    ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                    ->get();

            $total = 0;

            return response()->json([
                'current' => (int) $current,
                'rowCount' => (int) $rowCount,
                'rows' => $rows,
                'total' => $total
            ], 200);
        endif;
        return response()->json(['message' => 'SEX!'], 404);
    }
    
    static function validationRules($layer)
    {
        $field = [];
        foreach(Question::where('layerId', $layer)->get() as $q) :
            $rules = [];
            if($q->questionIsMandatory) :
                array_push($rules, 'required');
            endif;
            
            if($q->questionFormType == 'email') :
                array_push($rules, 'email');
            endif;
            
            if($q->questionFormType == 'number') :
                array_push($rules, 'numeric');
            endif;
            
            if($q->questionFormType == 'date') :
                array_push($rules, 'date:Y-m-d');
            endif;
            
            $field[camel_case($q->questionText)] = implode('|', $rules);
        endforeach;
        
        return $field;
    }
    
    public function validateAudienceLayer(Request $request)
    {
        if ($request->ajax()) :
            $validator = Validator::make($request->all(), $this->validationRules($request->layerId));
            $response = $validator->fails() ? $validator->errors() : $request;
            return response()->json($response, $validator->fails() ? 422 : 200);
        endif;
        
        return response()->json(['message' => 'SEX!'], 404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $layer = Layer::with('question.master')->get();
        return view('audiences.audience.create', compact('layer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) :
            $validator = Validator::make($request->all(), Audience::$rules + AudienceActivity::$rules);
        
            if ($validator->fails()) :
                return response()->json($validator->errors(), 422);
            endif;
            
            $create = Audience::create($request->all());
            
            foreach(Layer::all() as $l) :
                $audienceLayerResponse = [];
                $except = ['_token', 'audienceType', 'activityId', 'clubId','memberId', 'layerId'];
                foreach(Question::where('layerId', $l->layerId)->get() as $q) :
                    $questionText = camel_case($q->questionText);
                    if(array_key_exists($questionText, $request->all())) :
                        $audienceLayerResponse[$q->questionId] = $request->input($questionText);
                        $except[] = $questionText;
                    endif;
                endforeach;
                
                //array_push($audienceLayerResponse, $request->except($except));
                
                AudienceLayer::create([
                    'audienceId' => $create->audienceId,
                    'layerId' => $l->layerId,
                    'audienceLayerResponse' => collect($audienceLayerResponse)->toJson()
                ]);
            endforeach;
            
            AudienceActivity::create([
                'activityId' => $request->activityId,
                'audienceId' => $create->audienceId
            ]);
            
            return response()->json(['create' => $create], 200);
        endif;
        
        return response()->json(['message' => 'SEX!'], 404);
        
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $audience = Audience::with('layers.question.master', 'activities')->find($id);
        return view('audiences.audience.show', compact('audience'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $audience = Audience::with('layers.question.master', 'activities')->find($id);
        return view('audiences.audience.edit', compact('audience'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
