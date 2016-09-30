<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;
    
    public $primaryKey = 'activityId';
    protected $fillable = ['sourceId', 'mediaGroupId', 'activityName', 'activityWhere', 'activityWhen', 'activityToken'];
    protected $dates = ['deleted_at'];
    
    public static $rules = [
        'sourceId' => 'required|exists:sources,sourceId',
        'mediaGroupId' => 'required|exists:mediaGroups,mediaGroupId',
        'activityName' => 'required|string|max:127|unique:activities,activityName,NULL,activityId,deleted_at,NULL',
        'activityWhere' => 'string',
        'activityWhen' => 'date_format:Y-m-d'
    ];
    
    public function source() 
    {
        return $this->hasOne('App\Source', 'sourceId', 'sourceId');
    }
    
    public function mediaGroup()
    {
        return $this->hasOne('App\MediaGroup', 'mediaGroupId', 'mediaGroupId');
    }
        
}