<?php

namespace GMC;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model
{
    use SoftDeletes;
    
    public $primaryKey = 'uploadId';
    protected $fillable = ['uploadFilename', 'uploadIsExecuted'];
    public static $rules = ['uploadFilename' => 'string|max:127|unique:uploads', 'file' => 'file|max:2048'];
    protected $casts = ['uploadIsExecuted' => 'boolean'];
    protected $dates = ['deleted_at'];
}
