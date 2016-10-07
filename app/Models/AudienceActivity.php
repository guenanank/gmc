<?php

namespace GMC\Models;

use Illuminate\Database\Eloquent\Model;

class AudienceActivity extends Model {

    protected $table = 'audienceActivity';
    protected $fillable = ['audienceId', 'activityId'];
    public $timestamps = false;
    public static $rules = [
        'activityId' => 'required|exists:activities,activityId',
        'audienceId' => 'exists:audiences,audienceId'
    ];

    public function audiences() {
        return $this->hasMany('\GMC\Models\Audience', 'audienceId', 'audienceId');
    }

    public function activities() {
        return $this->hasMany('\GMC\Models\Activity', 'activityId', 'activityId');
    }

}
