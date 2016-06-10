<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    public $primaryKey = 'interestId';
    protected $fillable = ['interestSubFrom', 'interestName'];
    
    public function childs()
    {
        return $this->hasMany('App\Interest', 'interestSubFrom');
    }

    public function parent()
    {
        return $this->belongsTo('App\Interest', 'interestSubFrom');
    }
}
