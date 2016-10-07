<?php

namespace GMC\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model {

    public $primaryKey = 'mediaId';
    protected $fillable = ['mediaTypeId', 'mediaName'];
    public static $rules = [
        'mediaName' => 'required|string|max:127|unique:media',
        'mediaTypeId' => 'required|exists:mediaTypes,mediaTypeId'
    ];

    public function mediaType() {
        return $this->hasOne('\GMC\Models\MediaType', 'mediaTypeId', 'mediaTypeId');
    }

}
