<?php

namespace App\Containers;

use Illuminate\Http\Request;
use Illuminate\Container\Container;

use App\Audience;

class AudienceServiceContainer extends Container
{
    protected $request;
    public $audience;
    
    public function __construct(Request $request, Audience $audience)
    {
        $this->audience = $audience;
        $this->request = $request;
    }
    
    public function bootgridData()
    {
        $current = $this->request->input('current', 1);
        $rowCount = $this->request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $this->request->input('searchPhrase');
        $sortColumn = 'audienceId';
        $sortType = 'DESC';

        if(is_array($this->request->input('sort')))
        {
            foreach($this->request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        }

        $rows = Audience::where('audienceId', 'LIKE', '%' . $search . '%')
                ->orWhereHas('activities', function($query) use($search) {
                    $query->where('activityName', 'LIKE', '%' . $search . '%');
                })
                ->with('activities', 'layers')
                ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                ->get();

        $total = Audience::where('audienceId', 'LIKE', '%' . $search . '%')
                ->orWhereHas('activities', function($query) use($search) {
                    $query->where('activityName', 'LIKE', '%' . $search . '%');
                })
                ->with('activities', 'layers')
                ->count();

        return collect([
            'current' => (int) $current,
            'rowCount' => (int) $rowCount,
            'rows' => $rows,
            'total' => $total
        ]);
    }
    
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