<?php

namespace GMC\Models;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model {

    public $primaryKey = 'hobbyId';
    protected $fillable = ['hobbySubFrom', 'hobbyName'];
    public static $rules = [
        'hobbySubFrom' => 'exists:hobbies,hobbyId',
        'hobbyName' => 'required|string|max:127|unique:hobbies'
    ];
    protected $appends = ['hobbyParent'];

    public function getHobbyParentAttribute() {
        $parent = self::find($this->hobbySubFrom);
        return $parent ? $parent->hobbyName : null;
    }

    public function childs() {
        return $this->hasMany('\GMC\Models\Hobby', 'hobbySubFrom');
    }

    public function parent() {
        return $this->belongsTo('\GMC\Models\Hobby', 'hobbySubFrom');
    }

}
