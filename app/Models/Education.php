<?php

namespace GMC\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model {

    public $primaryKey = 'educationId';
    protected $fillable = ['educationName'];

    public static function rules($rules = []) {
        return array_merge($rules, ['educationName' => 'required|string|max:127|unique:education']);
    }

    public static function lists() {
        return self::all()->pluck('educationName', 'educationId')->all();
    }

}
