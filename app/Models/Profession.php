<?php

namespace GMC\Models;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model {

    public $primaryKey = 'professionId';
    protected $fillable = ['professionSubFrom', 'professionName'];
    public static $rules = [
        'professionSubFrom' => 'exists:professions,professionId',
        'professionName' => 'required|string|max:127|unique:professions'
    ];
    protected $appends = ['professionParent'];

    public function getProfessionParentAttribute() {
        $parent = self::find($this->professionSubFrom);
        return $parent ? $parent->professionName : null;
    }

    public function childs() {
        return $this->hasMany('\GMC\Models\Profession', 'professionSubFrom');
    }

    public function parent() {
        return $this->belongsTo('\GMC\Models\Profession', 'professionSubFrom');
    }

}
