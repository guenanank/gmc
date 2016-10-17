<?php

namespace GMC\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model {

    use SoftDeletes;

    public $primaryKey = 'uploadId';
    protected $fillable = ['uploadFilename', 'uploadIsExecuted'];
    protected $casts = ['uploadIsExecuted' => 'boolean'];
    protected $dates = ['deleted_at'];

    public static function rules($rules = []) {
        return array_merge($rules, ['uploadFilename' => 'string|max:127|unique:uploads', 'file' => 'file|max:2048']);
    }

}
