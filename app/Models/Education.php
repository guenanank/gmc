<?php

namespace GMC\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model {

    public $primaryKey = 'educationId';
    protected $fillable = ['educationName'];
    public static $rules = ['educationName' => 'required|string|max:127|unique:education'];

}
