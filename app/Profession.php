<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    public $primaryKey = 'professionId';
    protected $fillable = ['professionSubFrom', 'professionName'];
    
    public function childs()
    {
        return $this->hasMany('App\Profession', 'professionSubFrom');
    }

    public function parent()
    {
        return $this->belongsTo('App\Profession', 'professionSubFrom');
    }
}
