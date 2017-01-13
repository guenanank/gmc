<?php

namespace GMC\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {

    public $primaryKey = 'questionId';
    protected $fillable = [
        'layerId',
        'questionType',
        'masterId',
        'questionText',
        'questionSubText',
        'questionAnswer',
        'questionDesc',
        'questionFormType',
        'questionIsMandatory'
    ];
    protected $casts = ['questionIsMandatory' => 'boolean'];
    protected $nullable = [
        'masterId',
        'questionText',
        'questionAnswer',
        'questionDesc',
        'questionFormType'
    ];
    protected $appends = ['questionType'];

    public static function rules($rules = []) {
        return array_merge($rules, [
            'layerId' => 'required|exists:layers,layerId',
            'questionType' => 'required|string|max:31',
            'masterId' => 'required_if:questionType,useMaster|exists:masters,masterId',
            'questionText' => 'required_if:questionType,essay|string|max:255',
            'questionAnswer' => 'required_if:questionType,multipleChoice|required_if:questionType,trueOrFalse|string|max:255',
            'questionDesc' => 'string|max:255',
            'questionFormType' => 'required_unless:questionType,useMaster|string|max:31',
            'questionIsMandatory' => 'boolean'
        ]);
    }

    public static function questionType($type = null) {
        $questionType = [
            null => null,
            'essay' => 'Essay',
            'multipleChoice' => 'Multiple Choice',
            'trueOrFalse' => 'True Or False',
            'useMaster' => 'Use Master'
        ];


        return is_null($type) ? $questionType : $questionType[camel_case($type)];
    }

    public static function questionFormType() {
        return [
            null => null,
            'text' => 'Text',
            'textarea' => 'Textarea',
            //'hidden' => 'Hidden',
            'password' => 'Password',
            'email' => 'Email',
            //'file' => 'File',
            //'checkbox' => 'Checkbox',
            //'radio' => 'Radio',
            'number' => 'Number',
            'date' => 'Date',
            'select' => 'Select'
        ];
    }

    protected static function boot() {
        parent::boot();

        static::creating(function($model) {
            self::setNullables($model);
        });

        static::updating(function($model) {
            self::setNullables($model);
        });
    }

    protected static function setNullables($model) {
        foreach ($model->nullable as $field) {
            if (empty($model->{$field})) {
                $model->{$field} = null;
            }
        }
    }

    public function getQuestionTypeAttribute() {
        $original = $this->getOriginal('questionType');
        return self::questionType($original);
    }

    public function getQuestionAnswerAttribute($value) {
        if (!empty($value)) {
            $answer = [];
            foreach (explode(',', $value) as $item) {
                $item = trim($item);
                $answer[camel_case($item)] = $item;
            }

            return $answer;
        }

        return $value;
    }
    
    public function getQuestionSubTextAttribute($value) {
        if(!empty($value)) :
            return collect(json_decode($value));
        endif;
        
        return $value;
    }

    public function master() {
        return $this->hasOne('\GMC\Models\Master', 'masterId', 'masterId');
    }

    public function layer() {
        return $this->belongsTo('\GMC\Models\Layer', 'layerId');
    }

}
