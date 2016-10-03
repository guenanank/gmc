<?php

namespace GMC\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\MediaGroup;

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
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'mediaGroupId';
        $sortType = 'DESC';
        
        if(is_array($request->input('sort'))) :
            foreach($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;
        
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
        ], 200);
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
        $validator = Validator::make($request->all(), MediaGroup::$rules);
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $create = MediaGroup::create($request->all());
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
        $mediaGroup = MediaGroup::findOrFail($id);
        MediaGroup::$rules['mediaGroupName'] = 'required|string|max:127|unique:mediaGroups,mediaGroupName,' . $mediaGroup->mediaGroupId . ',mediaGroupId';
        $validator = Validator::make($request->all(), MediaGroup::$rules);
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $update = $mediaGroup->update($request->all());
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
        $mediaGroup = MediaGroup::findOrFail($id);
        $delete = $mediaGroup->delete();
        return response()->json($delete, 200);
    }
}