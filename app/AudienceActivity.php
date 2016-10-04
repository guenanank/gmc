<?php

namespace GMC;

use Illuminate\Database\Eloquent\Model;

class AudienceActivity extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'audienceActivity';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['audienceId', 'activityId'];
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    public static $rules = [
        'activityId' => 'required|exists:activities,activityId',
        'audienceId' => 'exists:audiences,audienceId'
    ];
    
    public function audiences()
    {
        return $this->hasMany('GMC\Audience', 'audienceId', 'audienceId');
    }
    
    public function activities()
    {
        return $this->hasMany('GMC\Activity', 'activityId', 'activityId');
    }
}
