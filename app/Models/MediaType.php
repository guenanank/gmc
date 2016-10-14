<?php

namespace GMC\Models;

use Illuminate\Database\Eloquent\Model;

class MediaType extends Model {

    protected $table = 'mediaTypes';
    public $primaryKey = 'mediaTypeId';
    protected $fillable = ['mediaTypeName'];

    public static function rules($rules = []) {
        return array_merge($rules, ['mediaTypeName' => 'required|string|max:127|unique:mediaTypes']);
    }

}
