<?php

namespace GMC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Layer extends Model {
    
    use SoftDeletes;

    public $primaryKey = 'layerId';
    protected $fillable = ['layerName', 'layerDesc'];

    public static function rules($rules = []) {
        return array_merge($rules, [
            'layerName' => 'required|string|max:127|unique:layers',
            'layerDesc' => 'string'
        ]);
    }

    public function questions() {
        return $this->hasMany('\GMC\Models\Question', 'layerId');
    }

}
