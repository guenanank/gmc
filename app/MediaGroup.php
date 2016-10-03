<?php

namespace GMC;

use Illuminate\Database\Eloquent\Model;

class MediaGroup extends Model
{
    protected $table = 'mediaGroups';
    public $primaryKey = 'mediaGroupId';
    protected $fillable = ['mediaGroupSubFrom', 'mediaGroupName', 'mediaGroupMap'];
    
    public static $rules = [
        'mediaGroupSubFrom' => 'exists:mediaGroups,mediaGroupId',
        'mediaGroupName' => 'required|string|max:127|unique:mediaGroups',
        'mediaGroupMap' => 'string|max:15'
    ];
    
    public function child()
    {
        return $this->hasMany('GMC\MediaGroup', 'mediaGroupSubFrom');
    }

    public function parent()
    {
        return $this->belongsTo('GMC\MediaGroup', 'mediaGroupSubFrom');
    }
    
    public function activity() 
    {
        return $this->hasMany('GMC\Activity', 'activityId');
    }
}
