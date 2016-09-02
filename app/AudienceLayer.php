<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AudienceLayer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'audienceLayer';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['audienceId', 'layerId', 'audienceLayerResponse'];
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    public static $rules = [
        'layerId' => 'exists:layers,layerId',
        'audienceId' => 'exists:audiences,audienceId'
    ];
    
    public function getAudienceLayerResponseAttribute($value)
    {
        $audienceLayerResponse = [];
        if(!empty($value))
        {
            $audienceLayerResponse = json_decode($value);
        }
        
        return collect($audienceLayerResponse);
    }
    
}
