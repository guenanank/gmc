<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audience extends Model
{
    public $primaryKey = 'audienceId';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['audienceType', 'clubId', 'memberId', 'customerId'];
 
    protected $nullable = ['clubId', 'memberId'];
    
    protected static function boot() 
    {
        parent::boot();

        static::creating(function($model) 
        {
            self::setNullables($model);
        });
        
        static::updating(function($model)
        {
            self::setNullables($model);
        });
    }
    
    /**
     * Set empty nullable fields to null
     * @param object $model
     */
    protected static function setNullables($model) 
    {
        foreach ($model->nullable as $field) :
            if (empty($model->{$field})) :
                $model->{$field} = null;
            endif;
        endforeach;
    }
    
    public function getAudienceTypeAttribute($value)
    {
        return self::$audienceType[$value];
    }
    
    /**
     *  Get the activities for the audience
     */
    public function activities()
    {
        return $this->belongsToMany('App\Activity', 'audienceActivity', 'audienceId', 'activityId');
    }
    
    /**
     *  Get the layer question data for the audience
     */
    public function layers()
    {
        return $this->belongsToMany('App\Layer', 'audienceLayer', 'audienceId', 'layerId')->withPivot('audienceLayerResponse');
    }
    
    public static $rules = [
        'audienceType' => 'required'
    ];
    
}
