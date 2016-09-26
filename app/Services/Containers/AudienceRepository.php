<?php

namespace App\Services\Containers;

use Illuminate\Http\Request;
use Illuminate\Container\Container;

use App\Audience;
use App\Question;

class AudienceRepository extends Container
{
    public function validationRules($layerId = 0)
    {
        $field = [];
        foreach(Question::where('layerId', $layerId)->get() as $q) :
            $rules = [];
            if($q->questionIsMandatory) :
                array_push($rules, 'required');
            endif;
            
            if($q->questionFormType == 'email') :
                array_push($rules, 'email');
            endif;
            
            if($q->questionFormType == 'number') :
                array_push($rules, 'numeric');
            endif;
            
            if($q->questionFormType == 'date') :
                array_push($rules, 'date:Y-m-d');
            endif;
            
            $field[camel_case($q->questionText)] = implode('|', $rules);
        endforeach;
        
        return $field;
    }
}