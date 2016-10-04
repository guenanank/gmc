<?php

namespace GMC\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model {

    public $primaryKey = 'expenseId';
    protected $fillable = ['expenseMin', 'expenseMax'];
    public static $rules = [
        'expenseMin' => 'required|numeric|between:0,999.999.999.999.999,9|unique:expenses',
        'expenseMax' => 'required|numeric|between:0,999.999.999.999.999,9|greater_than:expenseMin'
    ];

}
