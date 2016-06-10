<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Media;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('masters.media.index');
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
        $sortColumn = 'mediaName';
        $sortType = 'ASC';
        
        if(is_array($request->input('sort')))
        {
            foreach($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        }
        
        $rows = Media::where('mediaName', 'like', '%' . $search . '%')
                    ->orWhereHas('mediaType', function($query) use ($search) {
                            $query->where('mediaTypeName', 'LIKE', '%' . $search . '%');
                        })->with('mediaType')
                    ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                    ->get();
        
        $total = Media::where('mediaName', 'like', '%' . $search . '%')
                    ->orWhereHas('mediaType', function($query) use ($search) {
                            $query->where('mediaTypeName', 'LIKE', '%' . $search . '%');
                        })->with('mediaType')
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
        return view('masters.media.create');
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
                'mediaName' => 'required|string|max:127|unique:media',
                'mediaTypeId' => 'required|exists:mediaTypes,mediaTypeId'
            ]);
            
            if ($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }
            
            $create = Media::create($request->all());
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
        $media = Media::findOrFail($id);
        return view('masters.media.edit', compact('media'));
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
            $media = Media::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'mediaName' => 'required|string|max:127|unique:media,mediaName,' . $media->mediaId . ',mediaId',
                'mediaTypeId' => 'required|exists:mediaTypes,mediaTypeId'
            ]);
            
            if ($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }
            
            $media->update($request->all());
            return response()->json($media, 200);
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
        $media = Media::findOrFail($id);
        $media->delete();
        return response()->json($media);
    }
}
