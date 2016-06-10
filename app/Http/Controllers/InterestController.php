<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Interest;

class InterestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('masters.interest.index');
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
        $sortColumn = 'interestName';
        $sortType = 'ASC';
        
        if(is_array($request->input('sort')))
        {
            foreach($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        }
        
        $rows = Interest::where('interestName', 'like', '%' . $search . '%')
                    ->orWhereHas('parent', function($query) use ($search) {
                            $query->where('interestName', 'LIKE', '%' . $search . '%');
                        })->with('parent')
                    ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                    ->get();

        $total = Interest::where('interestName', 'like', '%' . $search . '%')
                    ->orWhereHas('parent', function($query) use ($search) {
                            $query->where('interestName', 'LIKE', '%' . $search . '%');
                        })->with('parent')
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
        return view('masters.interest.create');
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
                'interestSubFrom' => 'exists:interests,interestId',
                'interestName' => 'required|string|max:127|unique:interests',
            ]);
            
            if ($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }
            
            $create = Interest::create($request->all());
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
        $interest = Interest::findOrFail($id);
        return view('masters.interest.edit', compact('interest'));
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
            $interest = Interest::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'interestSubFrom' => 'exists:interests,interestId',
                'interestName' => 'required|string|max:127|unique:interests,interestName,' . $interest->interestId . ',interestId',
            ]);
            
            if ($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }
            
            $interest->update($request->all());
            return response()->json($interest, 200);
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
        $interest = Interest::findOrFail($id);
        $interest->delete();
        return response()->json($interest);
    }
}
