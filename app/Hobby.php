<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    public $primaryKey = 'hobbyId';
    protected $fillable = ['hobbySubFrom', 'hobbyName'];
    
    public function childs()
    {
        return $this->hasMany('App\Hobby', 'hobbySubFrom');
    }

    public function parent()
    {
        return $this->belongsTo('App\Hobby', 'hobbySubFrom');
    }
}
