<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    public $primaryKey = 'expenseId';
    protected $fillable = ['expenseMin', 'expenseMax'];
}
