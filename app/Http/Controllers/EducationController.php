<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Education;

class EducationController extends Controller 
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        return view('masters.education.index');
    }

    public function bootgrid(Request $request) 
    {
        if ($request->ajax() == false)
        {
            return response()->json(['message' => 'SEX!'], 404);
        }
        
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'educationId';
        $sortType = 'DESC';
        
        if(is_array($request->input('sort')))
        {
            foreach($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        }

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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return view('masters.education.create');
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
            $validator = Validator::make($request->all(), Education::$rules);
            if ($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }
            
            $create = Education::create($request->all());
            dd($create);
            return response()->json(['create' => $create], 200);
        }
        
        return response()->json(['message' => 'SEX!'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {
        $education = Education::findOrFail($id);
        return view('masters.education.edit', compact('education'));
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
            $education = Education::findOrFail($id);
            Education::$rules['educationName'] = 'required|string|max:127|unique:education,educationName,' . $education->educationId . ',educationId';
            $validator = Validator::make($request->all(), Education::$rules);
            
            if ($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }
            
            $update = $education->update($request->all());
            return response()->json(['update' => $update], 200);
        }
        
        return response()->json(['message' => 'SEX!'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) 
    {
        $education = Education::findOrFail($id);
        $delete = $education->delete();
        return response()->json($delete, 200);
    }

}
