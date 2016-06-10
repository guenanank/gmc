<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audience extends Model
{
    public $primaryKey = 'audienceId';
    
    public function type()
    {
        return $this->hasOne('App\AudienceType', 'audienceTypeId', 'audienceTypeId');
    }
}
