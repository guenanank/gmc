<?php
//$arr = [
//    [
//        'name' => 'districts',
//        'useApi' => [
//            'key' => str_random(7),
//            'target' => 'http://'
//        ],
//        'form' => [
//            'isMultiple' => false,
//            'index' => 'districtId',
//            'value' => [
//                'districtName'
//            ]
//        ]
//    ],
//    [
//        'name' => 'cities',
//        'useApi' => [
//            'key' => str_random(7),
//            'target' => 'http://'
//        ],
//        'form' => [
//            'isMultiple' => false,
//            'index' => 'cityId',
//            'value' => [
//                'cityName'
//            ]
//        ]
//    ],
//    [
//        'name' => 'provinces',
//        'useApi' => [
//            'key' => str_random(7),
//            'target' => 'http://'
//        ],
//        'form' => [
//            'isMultiple' => false,
//            'index' => 'provinceId',
//            'value' => [
//                'provinceName'
//            ]
//        ]
//    ],
//    [
//        'name' => 'postCodes',
//        'useApi' => [
//            'key' => str_random(7),
//            'target' => 'http://'
//        ],
//        'form' => [
//            'isMultiple' => false,
//            'index' => 'postCode',
//            'value' => [
//                'postCode'
//            ]
//        ]
//    ],
//    [
//        'name' => 'dwellings',
//        'useApi' => [
//            'key' => str_random(7),
//            'target' => 'http://'
//        ],
//        'form' => [
//            'isMultiple' => false,
//            'index' => 'dwellingId',
//            'value' => [
//                'dwellingName'
//            ]
//        ]
//    ]
//];
//
//$obj = collect($arr);
//die($obj->toJson());
?>
<div class="row m-b-10">
    <div class="col-sm-offset-1 col-sm-10">
        <div class="form-group fg-float">
            <div class="fg-line">
                @if(isset($question->master))
                @foreach($question->master->masterFormat as $format)
                @continue(empty($format))

                <select {{ $format->form->isMultiple ? 'multiple' : null }} name="{{ $format->name }}" class="form-control fg-input">
                    <option value="" selected></option>
                    @foreach(DB::table($format->name)->get() as $option)
                    <option value="{{ $option->{$format->form->index} }}">
                        @foreach($format->form->value as $k => $val)
                        @unless($option->{$val} == '0')
                        {{ is_numeric($option->{$val}) ? number_format($option->{$val}) : $option->{$val} }}
                        @if(($k + 1) != count($format->form->value))
                        &nbsp; - &nbsp;
                        @endif
                        @endunless
                        @endforeach
                    </option>
                    @endforeach
                </select>
                {!! Form::label(camel_case($format->name), ucwords($format->name), ['class' => 'fg-label']) !!}

                @endforeach
                @else
                @if($question->questionType == 'True Or False (Choice)')
                {!! Form::select(camel_case($question->questionText), ['' => ''] + $question->questionAnswer, null, ['class' => 'form-control fg-input']) !!}
                @else
                @if($question->questionFormType == 'text')
                {!! Form::text(camel_case($question->questionText), null, ['class' => 'form-control fg-input']) !!}
                @elseif($question->questionFormType == 'textarea')
                {!! Form::textarea(camel_case($question->questionText), null, ['class' => 'form-control fg-input auto-size', 'cols' => '', 'rows' => '']) !!}
                @elseif($question->questionFormType == 'password')
                {!! Form::password(camel_case($question->questionText), null, ['class' => 'form-control fg-input']) !!}
                @elseif($question->questionFormType == 'email')
                {!! Form::email(camel_case($question->questionText), null, ['class' => 'form-control fg-input']) !!}
                @elseif($question->questionFormType == 'file')
                {!! Form::file(camel_case($question->questionText), null, ['class' => 'form-control fg-input']) !!}
                @elseif($question->questionFormType == 'checkbox')
                {!! Form::checkbox(camel_case($question->questionText), null, ['class' => 'form-control fg-input']) !!}
                @elseif($question->questionFormType == 'radio')
                {!! Form::radio(camel_case($question->questionText), null, ['class' => 'form-control fg-input']) !!}
                @elseif($question->questionFormType == 'number')
                {!! Form::number(camel_case($question->questionText), null, ['class' => 'form-control fg-input']) !!}
                @elseif($question->questionFormType == 'date')
                {!! Form::date(camel_case($question->questionText), null, ['class' => 'form-control fg-input input-mask', 'data-mask' => '0000-00-00']) !!}
                @elseif($question->questionFormType == 'select')
                {!! Form::select(camel_case($question->questionText), [], null, ['class' => 'form-control fg-input']) !!}
                @else
                {{ $question->questionFormType }}
                @endif
                @endif
                {!! Form::label(camel_case($question->questionText), $question->questionText, ['class' => 'fg-label']) !!}
                @endif
            </div>
            <small id="{{ camel_case($question->questionText) }}" class="help-block"></small>
        </div>
    </div>
</div>