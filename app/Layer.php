<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layer extends Model
{
    public $primaryKey = 'layerId';
    protected $fillable = ['layerName', 'layerDesc'];
    
    public static $rules = [
        'layerName' => 'required|string|max:127|unique:layers',
        'layerDesc' => 'string'
    ];

    public function question()
    {
        return $this->hasMany('App\Question', 'layerId');
    }
}

