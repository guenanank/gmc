<?php

namespace GMC\Models;

use Illuminate\Database\Eloquent\Model;

class MediaType extends Model {

    protected $table = 'mediaTypes';
    public $primaryKey = 'mediaTypeId';
    protected $fillable = ['mediaTypeName'];
    public static $rules = ['mediaTypeName' => 'required|string|max:127|unique:mediaTypes'];

}
