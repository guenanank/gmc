<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $primaryKey = 'questionId';
    
    protected $fillable = [
        'layerId',
        'questionType',
        'masterId',
        'questionText',
        'questionAnswer',
        'questionDesc',
        'questionFormType',
        'questionIsMandatory'
    ];
    
    protected $casts = [
        'questionIsMandatory' => 'boolean'
    ];
    
    protected $nullable = [
        'masterId',
        'questionText',
        'questionAnswer',
        'questionDesc',
        'questionFormType'
    ];
    
    public static $rules = [
        'layerId' => 'required|exists:layers,layerId',
        'questionType' => 'required|string|max:31',
        'masterId' => 'required_if:questionType,useMaster|exists:masters,masterId',
        'questionText' => 'required_if:questionType,essay|string|max:255',
        'questionAnswer' => 'required_if:questionType,multipleChoice|required_if:questionType,trueOrFalse|string|max:255',
        'questionDesc' => 'string|max:255',
        'questionFormType' => 'required_unless:questionType,useMaster|string|max:31',
        'questionIsMandatory' => 'boolean'
    ];

    public static $questionType = [
        '' => '',
        'essay' => 'Essay',
        'multipleChoice' => 'Multiple Choice',
        'trueOrFalse' => 'True Or False (Choice)',
        'useMaster' => 'Use Master Data'
    ];
    
    public static $questionFormType = [
        '' => '',
        //'label' => 'Label',
        'text' => 'Text',
        'textarea' => 'Textarea',
        'hidden' => 'Hidden',
        'password' => 'Password',
        'email' => 'Email',
        'file' => 'File',
        'checkbox' => 'Checkbox',
        'radio' => 'Radio',
        'number' => 'Number',
        'date' => 'Date',
        'select' => 'Select',
        //'selectRange' => 'Select Between',
        //'selectMonth' => 'Select Month',
        //'submit' => 'Submit',
    ];
    
    protected $appends = ['questionType'];

    protected static function boot() 
    {
        parent::boot();

        static::creating(function($model) 
        {
            self::setNullables($model);
        });
        
        static::updating(function($model)
        {
            self::setNullables($model);
        });
    }
    
    /**
     * Set empty nullable fields to null
     * @param object $model
     */
    protected static function setNullables($model) 
    {
        foreach ($model->nullable as $field) 
        {
            if (empty($model->{$field})) 
            {
                $model->{$field} = null;
            }
        }
    }
    
    /**
     * Get the question type value.
     *
     * @param  string  $value
     * @return string
     */
    public function getQuestionTypeAttribute($value)
    {
        $getOriginal = $this->getOriginal('questionType');
        return Question::$questionType[$getOriginal];
//        return Question::$questionType[$value];
    }
    
    public function getQuestionAnswerAttribute($value)
    {
        if(!empty($value))
        {
            $answer = [];
            foreach(explode(',', $value) as $item)
            {
                $item = trim($item);
                $answer[camel_case($item)] = $item;
            }
            
            return $answer;
        }
        
        return $value;
    }
    
    public function master()
    {
        return $this->hasOne('App\Master', 'masterId', 'masterId');
    }
    
    public function layer()
    {
        return $this->belongsTo('App\Layer', 'layerId');
    }
}
