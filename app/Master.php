<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    public $primaryKey = 'masterId';
    
    public function getMasterFormatAttribute($value)
    {
        $masterFormat = [];
        if(!empty($value))
        {
            $masterFormat = json_decode($value);
        }
        
        return collect($masterFormat);
    }
    
    public function question()
    {
        return $this->belongsTo('App\Question', 'masterId');
    }
    
    
}
