<?php

namespace GMC\Models;

use Illuminate\Database\Eloquent\Model;

class Layer extends Model {

    public $primaryKey = 'layerId';
    protected $fillable = ['layerName', 'layerDesc'];
    public static $rules = [
        'layerName' => 'required|string|max:127|unique:layers',
        'layerDesc' => 'string'
    ];

    public function questions() {
        return $this->hasMany('\GMC\Models\Question', 'layerId');
    }

}
