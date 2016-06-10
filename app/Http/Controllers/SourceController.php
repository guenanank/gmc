<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Source;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        return view('masters.source.index');
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
        $sortColumn = 'sourceName';
        $sortType = 'ASC';
        
        if(is_array($request->input('sort')))
        {
            foreach($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        }
        
        $rows = Source::where('sourceName', 'like', '%' . $search . '%')
                    ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                    ->get();
        
        $total = Source::where('sourceName', 'like', '%' . $search . '%')
                    ->count();

        return response()->json([
            'current' => (int) $current,
            'rowCount' => (int) $rowCount,
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
        return view('masters.source.create');
        
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
                'sourceName' => 'required|string|max:127|unique:sources',
            ]);
            
            if ($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }
            
            $create = Source::create($request->all());
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
        $source = Source::findOrFail($id);
        return view('masters.source.edit', compact('source'));
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
            $source = Source::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'sourceName' => 'required|string|max:127|unique:sources,sourceName,' . $source->sourceId . ',sourceId',
            ]);
            
            if ($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }
            
            $source->update($request->all());
            return response()->json($source, 200);
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
        $source = Source::findOrFail($id);
        $source->delete();
        return response()->json($source);
    }
}
