<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Expense;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('masters.expense.index');
    }
    
    public function bootgrid(Request $request) 
    {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'expenseId';
        $sortType = 'DESC';
        
        if(is_array($request->input('sort'))) :
            foreach($request->input('sort') as $key => $value) :
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        $rows = Expense::where('expenseMin', 'like', '%' . $search . '%')
                    ->orWhere('expenseMax', 'like', '%' . $search . '%')
                    ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                    ->get();

        $total = Expense::where('expenseMin', 'like', '%' . $search . '%')
                    ->orWhere('expenseMax', 'like', '%' . $search . '%')
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
        return view('masters.expense.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Expense::$rules);
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $create = Expense::create($request->all());
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
        $expense = Expense::findOrFail($id);
        return view('masters.expense.edit', compact('expense'));
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
        $expense = Expense::findOrFail($id);
        $validator = Validator::make($request->all(), Expense::$rules);
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $update = $expense->update($request->all());
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
        $expense = Expense::findOrFail($id);
        $delete = $expense->delete();
        return response()->json($delete, 200);
    }
}
