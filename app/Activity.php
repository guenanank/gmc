<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;
    
    public $primaryKey = 'activityId';
    protected $fillable = ['sourceId', 'mediaGroupId', 'activityName', 'activityWhere', 'activityWhen'];
    protected $dates = ['deleted_at'];
    
    public function source() 
    {
        return $this->hasOne('App\Source', 'sourceId', 'sourceId');
    }
    
    public function mediaGroup()
    {
        return $this->hasOne('App\MediaGroup', 'mediaGroupId', 'mediaGroupId');
    }
}