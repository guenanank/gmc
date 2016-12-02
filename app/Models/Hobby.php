<?php

namespace GMC\Models;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model {

    public $primaryKey = 'hobbyId';
    protected $fillable = ['hobbySubFrom', 'hobbyName'];
    protected $appends = ['hobbyParent'];

    public static function rules($rules = []) {
        return array_merge($rules, [
            'hobbySubFrom' => 'exists:hobbies,hobbyId',
            'hobbyName' => 'required|string|max:127|unique:hobbies'
        ]);
    }

    public function getHobbyParentAttribute() {
        $parent = self::find($this->hobbySubFrom);
        return $parent ? $parent->hobbyName : null;
    }
    
    public function getHobbySubFromAttribute($value) {
        $parent = self::find($value);
        return $parent ? $parent->hobbyName : null;
    }

    public function childs() {
        return $this->hasMany('\GMC\Models\Hobby', 'hobbySubFrom');
    }

    public function parent() {
        return $this->belongsTo('\GMC\Models\Hobby', 'hobbySubFrom');
    }
    
    public static function lists() {
        $lists = [];
        foreach (self::select('hobbyId', 'hobbyName', 'hobbySubFrom')->get() as $hobby) :
            if($hobby->hobbySubFrom) :
                $lists[$hobby->hobbyId] = $hobby->hobbySubFrom . ' - ' . $hobby->hobbyName;
            else :
                $lists[$hobby->hobbyId] = $hobby->hobbyName;
            endif;
        endforeach;

        return $lists;
    }

}
