<?php

namespace GMC\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model {

    use SoftDeletes;

    public $primaryKey = 'uploadId';
    protected $fillable = ['uploadFilename', 'uploadIsExecuted'];
    public static $rules = ['uploadFilename' => 'string|max:127|unique:uploads', 'file' => 'file|max:2048'];
    protected $casts = ['uploadIsExecuted' => 'boolean'];
    protected $dates = ['deleted_at'];

}
