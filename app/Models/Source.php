<?php

namespace GMC\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model {

    public $primaryKey = 'sourceId';
    protected $fillable = ['sourceName', 'sourceType'];

    public static function sourceTypes($sourceType = null) {
        $sourceTypes = ['External Event', 'Internal Event'];
        return is_null($sourceType) ? $sourceTypes : $sourceTypes[$sourceType];
    }

    public static function rules($rules = [], $sourceType) {
        return array_merge($rules, [
            'sourceName' => 'required|string|max:127|unique:sources,sourceName,NULL,sourceId,sourceType,' . $sourceType,
            'sourceType' => 'required|boolean'
        ]);
    }

    public function activities() {
        return $this->hasMany('\GMC\Models\Activity', 'activityId');
    }

}
