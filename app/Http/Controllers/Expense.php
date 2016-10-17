<?php

namespace GMC\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Models\Expense as Expenses;

class Expense extends Controller {

    public function index(Request $request) {
        return view('masters.expense.index');
    }

    public function bootgrid(Request $request) {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'expenseMin';
        $sortType = 'ASC';

        if (is_array($request->input('sort'))) :
            foreach ($request->input('sort') as $key => $value) :
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        $rows = Expenses::where('expenseMin', 'like', '%' . $search . '%')
                ->orWhere('expenseMax', 'like', '%' . $search . '%')
                ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                ->get();

        $total = Expenses::where('expenseMin', 'like', '%' . $search . '%')
                ->orWhere('expenseMax', 'like', '%' . $search . '%')
                ->count();

        return response()->json([
                    'current' => (int) $current,
                    'rowCount' => (int) $rowCount,
                    'rows' => $rows,
                    'total' => $total
                        ], 200);
    }

    public function create() {
        return view('masters.expense.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), Expenses::rules());
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $create = Expenses::create($request->all());
        return response()->json(['create' => $create], 200);
    }

    public function edit($id) {
        $expense = Expenses::findOrFail($id);
        return view('masters.expense.edit', compact('expense'));
    }

    public function update(Request $request, $id) {
        $expense = Expenses::findOrFail($id);
        $validator = Validator::make($request->all(), Expenses::rules());
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        $update = $expense->update($request->all());
        return response()->json(['update' => $update], 200);
    }

    public function destroy($id) {
        $expense = Expenses::findOrFail($id);
        $delete = $expense->delete();
        return response()->json($delete, 200);
    }

}
