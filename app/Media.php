<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    public $primaryKey = 'mediaId';
    protected $fillable = ['mediaTypeId', 'mediaName'];
    
    public function mediaType()
    {
        return $this->hasOne('App\MediaType', 'mediaTypeId', 'mediaTypeId');
    }
}
