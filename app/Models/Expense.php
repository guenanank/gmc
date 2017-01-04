<?php

namespace GMC\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model {

    public $primaryKey = 'expenseId';
    protected $fillable = ['expenseMin', 'expenseMax'];

    public static function rules($rules = []) {
        return array_merge($rules, [
            'expenseMin' => 'required|numeric|between:0,999.999.999.999.999,9|unique:expenses',
            'expenseMax' => 'required|numeric|between:0,999.999.999.999.999,9|greater_than:expenseMin'
        ]);
    }

    public static function lists() {
        $lists = [];
        foreach (self::select('expenseId', 'expenseMin', 'expenseMax')->get() as $expense) :
            $lists[$expense->expenseId] = number_format($expense->expenseMin) . ' - ' . number_format($expense->expenseMax);
        endforeach;

        return $lists;
    }

}
