<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\MediaGroup;

class MediaGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('masters.mediaGroup.index');
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
        $sortColumn = 'mediaGroupName';
        $sortType = 'ASC';
        
        if(is_array($request->input('sort')))
        {
            foreach($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        }
        
        $rows = MediaGroup::where('mediaGroupName', 'like', '%' . $search . '%')
                        ->orWhereHas('parent', function($query) use ($search) {
                                $query->where('mediaGroupName', 'LIKE', '%' . $search . '%');
                            })->with('parent')
                        ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                        ->get();

        $total = MediaGroup::where('mediaGroupName', 'like', '%' . $search . '%')
                        ->orWhereHas('parent', function($query) use ($search) {
                                $query->where('mediaGroupName', 'LIKE', '%' . $search . '%');
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
        return view('masters.mediaGroup.create');
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
                'mediaGroupSubFrom' => 'exists:mediaGroups,mediaGroupId',
                'mediaGroupName' => 'required|string|max:127|unique:mediaGroups',
                'mediaGroupMap' => 'string|max:15'
            ]);
            
            if ($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }
            
            $create = MediaGroup::create($request->all());
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
        $mediaGroup = MediaGroup::findOrFail($id);
        return view('masters.mediaGroup.edit', compact('mediaGroup'));
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
            $mediaGroup = MediaGroup::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'mediaGroupSubFrom' => 'exists:mediaGroups,mediaGroupId',
                'mediaGroupName' => 'required|string|max:127|unique:mediaGroups,mediaGroupName,' . $mediaGroup->mediaGroupId . ',mediaGroupId',
                'mediaGroupMap' => 'string|max:15'
            ]);
            
            if ($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }
            
            $mediaGroup->update($request->all());
            return response()->json($mediaGroup, 200);
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
        $mediaGroup = MediaGroup::findOrFail($id);
        $mediaGroup->delete();
        return response()->json($mediaGroup);
    }
}