<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaGroup extends Model
{
    protected $table = 'mediaGroups';
    public $primaryKey = 'mediaGroupId';
    protected $fillable = ['mediaGroupSubFrom', 'mediaGroupName', 'mediaGroupMap'];
    
    public function childs()
    {
        return $this->hasMany('App\MediaGroup', 'mediaGroupSubFrom');
    }

    public function parent()
    {
        return $this->belongsTo('App\MediaGroup', 'mediaGroupSubFrom');
    }
    
    public function activity() 
    {
        return $this->hasMany('App\Activity', 'activityId');
    }
}
