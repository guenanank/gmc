<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LayerQuestion extends Model
{
    protected $table = 'layerQuestions';
    public $primaryKey = 'layerQuestionId';
    protected $fillable = ['layerQuestionDesc', 'layerQuestionText'];
    protected $casts = [
        'layerQuestionIsEnable' => 'boolean',
    ];
}
