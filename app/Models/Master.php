<?php

namespace GMC\Models;

use Illuminate\Database\Eloquent\Model;

class Master extends Model {

    public $primaryKey = 'masterId';

    public function getMasterFormatAttribute($value) {
        return collect(json_decode($value));
    }

    public function questions() {
        return $this->belongsTo('\GMC\Models\Question', 'masterId');
    }

}
