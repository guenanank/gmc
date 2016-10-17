<?php

namespace GMC\Models;

use Illuminate\Database\Eloquent\Model;

class MediaGroup extends Model {

    protected $table = 'mediaGroups';
    public $primaryKey = 'mediaGroupId';
    protected $fillable = ['mediaGroupSubFrom', 'mediaGroupName', 'mediaGroupMap'];

    public static function rules($rules = []) {
        return array_merge($rules, [
            'mediaGroupSubFrom' => 'exists:mediaGroups,mediaGroupId',
            'mediaGroupName' => 'required|string|max:127|unique:mediaGroups',
            'mediaGroupMap' => 'string|max:15'
        ]);
    }

    public function childs() {
        return $this->hasMany('\GMC\Models\MediaGroup', 'mediaGroupSubFrom');
    }

    public function parent() {
        return $this->belongsTo('\GMC\Models\MediaGroup', 'mediaGroupSubFrom');
    }

    public function activities() {
        return $this->hasMany('\GMC\Models\Activity', 'activityId');
    }

}
