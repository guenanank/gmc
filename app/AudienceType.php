<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AudienceType extends Model
{
    protected $table = 'audienceTypes';
    public $primaryKey = 'audienceTypeId';
    protected $fillable = ['audienceTypeName'];
}
