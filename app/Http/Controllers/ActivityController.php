<?php

namespace App\Http\Controllers;

use Crypt;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Activity;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('masters.activity.index');
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
        $sortColumn = 'activityId';
        $sortType = 'DESC';
        
        if(is_array($request->input('sort')))
        {
            foreach($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        }
        
        $rows = Activity::where('activityName', 'LIKE', '%' . $search . '%')
                    ->orWhere('activityWhere', 'LIKE', '%' . $search . '%')
                    ->orWhere('activityWhen', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('source', function($query) use ($search) {
                            $query->where('sourceName', 'LIKE', '%' . $search . '%');
                        })
                    ->orWhereHas('mediaGroup', function($query) use ($search) {
                            $query->where('mediaGroupName', 'LIKE', '%' . $search . '%');
                        })
                    ->with('source', 'mediaGroup')
                    ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                    ->get();
        
        $total = Activity::where('activityName', 'LIKE', '%' . $search . '%')
                    ->orWhere('activityWhere', 'LIKE', '%' . $search . '%')
                    ->orWhere('activityWhen', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('source', function($query) use ($search) {
                            $query->where('sourceName', 'LIKE', '%' . $search . '%');
                        })
                    ->orWhereHas('mediaGroup', function($query) use ($search) {
                            $query->where('mediaGroupName', 'LIKE', '%' . $search . '%');
                        })
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
        return view('masters.activity.create');
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
            $validator = Validator::make($request->all(), Activity::$rules);
            if ($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }
                        
            $request->merge(['activityToken' => Crypt::encrypt($request->activityName)]);
            $create = Activity::create($request->all());
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
        $activity = Activity::findOrFail($id);
        return view('masters.activity.edit', compact('activity'));
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
            $activity = Activity::find($id);
            Activity::$rules['activityName'] = 'required|string|max:127|unique:activities,activityName,' . $activity->activityId . ',activityId';
            $validator = Validator::make($request->all(), Activity::$rules);
            
            if ($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }
            
            $request->merge(['activityToken' => Crypt::encrypt($request->activityName)]);
            $update = $activity->update($request->all());
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
        $activity = Activity::findOrFail($id);
        $delete = $activity->delete();
        return response()->json($delete, 200);
    }
}
