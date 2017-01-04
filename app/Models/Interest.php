<?php

namespace GMC\Models;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model {

    public $primaryKey = 'interestId';
    protected $fillable = ['interestSubFrom', 'interestName'];
    protected $appends = ['interestParent'];

    public static function rules($rules = []) {
        return array_merge($rules, [
            'interestSubFrom' => 'exists:interests,interestId',
            'interestName' => 'required|string|max:127|unique:interests'
        ]);
    }

    public function getInterestParentAttribute() {
        $parent = self::find($this->interestSubFrom);
        return $parent ? $parent->interestName : null;
    }
    
    public function childs() {
        return $this->hasMany('\GMC\Models\Interest', 'interestSubFrom');
    }

    public function parent() {
        return $this->belongsTo('\GMC\Models\Interest', 'interestSubFrom');
    }
    
    public static function lists() {
        $lists = [];
        $insterests = self::select('interestId', 'interestName', 'interestSubFrom')->get();
        foreach ($insterests as $interest) :
            if($interest->interestSubFrom) :
                $interestSubFrom = $insterests->where('interestSubFrom', $interest->interestSubFrom)->first();
                $lists[$interest->interestId] = $interestSubFrom->interestName . ' - ' . $interest->interestName;
            else :
                $lists[$interest->interestId] = $interest->interestName;
            endif;
            
        endforeach;

        return $lists;
    }

}
