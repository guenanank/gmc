<?php

namespace GMC\Services\Containers;

use Illuminate\Http\Request;
use Illuminate\Container\Container;
use Validator;
use GMC\Models\Audience;
use GMC\Models\AudienceActivity;
use GMC\Models\Layer;
use GMC\Models\Question;
use GMC\Models\Activity;

class AudienceContainer extends Container {

    public static function Audience() {
        return new Audience;
    }

    public static function Layer() {
        return new Layer;
    }

    public static function Question() {
        return new Question;
    }

    public static function Activity() {
        return new Activity;
    }

    public static function validateAudienceLayer($request) {
        $validator = Validator::make($request->all(), self::validationRules($request->layerId));
        $response = $validator->fails() ? $validator->errors() : $request;
        return response()->json($response, $validator->fails() ? 422 : 200);
    }

    protected static function validationRules($layerId = 0) {
        $field = [];
        foreach (Question::where('layerId', $layerId)->get() as $q) :
            $rules = [];
            if ($q->questionIsMandatory) :
                array_push($rules, 'required');
            endif;

            if ($q->questionFormType == 'email') :
                array_push($rules, 'email');
            endif;

            if ($q->questionFormType == 'number') :
                array_push($rules, 'numeric');
            endif;

            if ($q->questionFormType == 'date') :
                array_push($rules, 'date:Y-m-d');
            endif;

            $field[camel_case($q->questionText)] = implode('|', $rules);
        endforeach;

        return $field;
    }

    public static function executeUploadedFile($readers) {
        $activity = self::findActivity($readers->getTitle());
        if ($activity) :
            foreach ($readers->chunk(50) as $i => $row) :
                if ($i >= 1) :
                    self::createAudience($row, $activity);
                endif;
            endforeach;
        endif;

        dd('execute');
    }

    private static function findActivity($token) {
        return Activity::select('activityId')->where('activityToken', $token)->firstOrFail();
    }

    private static function createAudience($readers, $activity) {
        foreach ($readers as $reader) :
            foreach ($reader as $key => $val) :
                $param = ['aId' => $activity->activityId, 'qId' => $key, 'qText' => $val];
                if (self::findAudience($param)) :
                //dd('gada');
                else :
                //dd('ada');
                endif;
            endforeach;

        endforeach;
    }

    private static function findAudience($parameter) {
        $audienceIsExists = Audience::whereHas('activities', function($a) use($parameter) {
                    $a->where('activities.activityId', $parameter['aId']);
                })->whereHas('layers', function($l) use($parameter) {
                    $l->whereHas('question', function($q) use($parameter) {
                        $q->where([
                            ['questionId', '=', $parameter['qId']],
                            ['questionIsMandatory', '=', true],
                            ['questionText', '=', $parameter['qText']]
                        ]);
                    });
                })->get();

        return $audienceIsExists->isEmpty();
    }

}
