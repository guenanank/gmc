<?php

namespace GMC;
use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    public $primaryKey = 'hobbyId';
    protected $fillable = ['hobbySubFrom', 'hobbyName'];
    
    public static $rules = [
        'hobbySubFrom' => 'exists:hobbies,hobbyId',
        'hobbyName' => 'required|string|max:127|unique:hobbies'
    ];
    
    protected $appends = ['hobbyParent'];
    
    public function getHobbyParentAttribute()
    {
        $parent = self::find($this->hobbySubFrom);
        return $parent ? $parent->hobbyName : null;
    }
    
    public function child()
    {
        return $this->hasMany('GMC\Hobby', 'hobbySubFrom');
    }

    public function parent()
    {
        return $this->belongsTo('GMC\Hobby', 'hobbySubFrom');
    }
    
    
}
