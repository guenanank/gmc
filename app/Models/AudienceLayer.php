<?php

namespace GMC\Models;

use Illuminate\Database\Eloquent\Model;

class AudienceLayer extends Model {

    protected $table = 'audienceLayer';
    protected $fillable = ['audienceId', 'layerId', 'audienceLayerResponse'];
    public $timestamps = false;
    public static $rules = [
        'layerId' => 'exists:layers,layerId',
        'audienceId' => 'exists:audiences,audienceId'
    ];

    public function getAudienceLayerResponseAttribute($value) {
        return collect(json_decode($value));
    }

}
