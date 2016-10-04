<?php

namespace GMC;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    public $primaryKey = 'sourceId';
    protected $fillable = ['sourceName'];
    
    public static $rules = ['sourceName' => 'required|string|max:127|unique:sources'];
    
    public function activity() 
    {
        return $this->hasMany('GMC\Activity', 'activityId');
    }
    
}
