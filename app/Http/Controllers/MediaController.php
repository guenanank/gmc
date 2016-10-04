<?php

namespace GMC\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Models\Media;

class MediaController extends Controller {

    public function index() {
        return view('masters.media.index');
    }

    public function bootgrid(Request $request) {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'mediaId';
        $sortType = 'DESC';

        if (is_array($request->input('sort'))) :
            foreach ($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

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
                        ], 200);
    }

    public function create() {
        $mediaTypes = \GMC\Models\MediaType::lists('mediaTypeName', 'mediaTypeId')->all();
        return view('masters.media.create', compact('mediaTypes'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), Media::$rules);
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $create = Media::create($request->all());
        return response()->json(['create' => $create], 200);
    }

    public function edit($id) {
        $media = Media::findOrFail($id);
        $mediaTypes = \GMC\Models\MediaType::lists('mediaTypeName', 'mediaTypeId')->all();
        return view('masters.media.edit', compact('media', 'mediaTypes'));
    }

    public function update(Request $request, $id) {
        $media = Media::findOrFail($id);
        Media::$rules['mediaName'] = 'required|string|max:127|unique:media,mediaName,' . $media->mediaId . ',mediaId';
        $validator = Validator::make($request->all(), Media::$rules);
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $update = $media->update($request->all());
        return response()->json(['update' => $update], 200);
    }

    public function destroy($id) {
        $media = Media::findOrFail($id);
        $delete = $media->delete();
        return response()->json($delete, 200);
    }

}
