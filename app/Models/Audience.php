<?php

namespace GMC\Models;

use Illuminate\Database\Eloquent\Model;

class Audience extends Model {

    public $primaryKey = 'audienceId';
    protected $fillable = ['audienceType', 'clubId', 'memberId', 'customerId'];
    protected $nullable = ['clubId', 'memberId'];

    public static function rules($rules = []) {
        return array_merge($rules, ['audienceType' => 'required']);
    }

    protected static function boot() {
        parent::boot();

        static::creating(function($model) {
            self::setNullables($model);
        });

        static::updating(function($model) {
            self::setNullables($model);
        });
    }

    protected static function setNullables($model) {
        foreach ($model->nullable as $field) :
            if (empty($model->{$field})) :
                $model->{$field} = null;
            endif;
        endforeach;
    }

    public function getAudienceTypeAttribute($value) {
        return self::$audienceType[$value];
    }

    public function activities() {
        return $this->belongsToMany('\GMC\Models\Activity', 'audienceActivity', 'audienceId', 'activityId');
    }

    public function layers() {
        return $this->belongsToMany('\GMC\Models\Layer', 'audienceLayer', 'audienceId', 'layerId')->withPivot('audienceLayerResponse');
    }

}
