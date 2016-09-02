@extends('layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard/', 'GMC') }}</li>
    <li>{{ link_to('audience/audience', 'Audience') }}</li>
    <li class="active">Create</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Create New Audience <small>Master data of audience.</small></h2>
        <a href="{{ action('AudienceController@index') }}" class="btn bgm-orange pull-right m-r-10 btn-icon" data-toggle="tooltip" data-placement="left" title="Back">
            <i class="zmdi zmdi-arrow-left"></i>
        </a>
    </div>
    <br />
    <div class="card-body card-padding">

        {{ Form::open(['route' => 'audience.audience.store', 'class' => 'ajaxForm']) }}
        {{ Form::hidden('audienceType', 'manual') }}
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <p class="f-500 c-black">SELECT ACTIVITY SOURCE</p>
                {!! Form::select('activityId', App\Activity::lists('activityName', 'activityId'), null, ['class' => 'form-control fg-input selectpicker', 'multiple' => true, 'data-selected-text-format' => 'count', 'data-live-search' => true]) !!}
                <small id="activityId" class="help-block"></small>
            </div>
        </div>
        
        <br />
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-line">
                    <p class="f-500 c-black">CLUB ID</p>
                    {!! Form::text('clubId', null, ['class' => 'form-control fg-input input-mask', 'data-mask' => '0000-000000']) !!}
                    <small id="clubId" class="help-block"></small>
                </div>
            </div>
        </div>
        
        <br />
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-line">
                    <p class="f-500 c-black">MEMBER ID</p>
                    {!! Form::text('memberId', null, ['class' => 'form-control fg-input']) !!}
                    <small id="memberId" class="help-block"></small>
                </div>
            </div>
        </div>
        
        <br />
        <div class="" id="formWizard">
            <div class="form-wizard-audience fw-container">
                <ul class="tab-nav text-center">
                    @foreach($layer as $tabNav)
                        <li>{{ link_to('#' . camel_case($tabNav->layerName), $tabNav->layerName, ['data-toggle' => 'tab']) }}</li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach($layer as $tabContent)
                        <div class="tab-pane fade {{ $tabContent->layerId == 1 ? 'active in' : null }}" id="{{ camel_case($tabContent->layerName) }}">
                            {{ Form::hidden('layerId', $tabContent->layerId) }}
                            @foreach($tabContent->question as $q)
                                <div class="row">
                                    <div class="col-sm-offset-1 col-sm-10">
                                        <div class="form-group fg-line">
                                            <p class="f-500 c-black">{{ strtoupper($q->questionText) }}<br /><small class="c-gray">{{ $q->questionDesc }}</small></p>
                                            @if(isset($q->master))
                                                @foreach($q->master->masterFormat as $format)
                                                    @if($q->master->masterUseAPI)
                                                        {{ Form::label($format->name, ucfirst($format->name) . ' (unset)') }}<br />
                                                    @else
                                                        {{--*/ $model = 'App\\' . str_singular(ucfirst($format->name)) /*--}}
                                                        <select {{ $format->form->isMultiple ? 'multiple data-selected-text-format="count"' : null }} name="{{ $format->name }}" class="form-control fg-input input-sm selectpicker" data-live-search="true">
                                                            <option value=""></option>
                                                            @foreach($model::all() as $option)
                                                                <option value="{{ $option->{$format->form->index} }}">
                                                                    @foreach($format->form->value as $key => $val)
                                                                        {{ is_numeric($option->{$val}) ? number_format($option->{$val}) : $option->{$val} }}
                                                                        @if(!empty($option->{$val}) && ($key + 1) < count($format->form->value))
                                                                            &nbsp;&HorizontalLine;&nbsp;
                                                                        @endif
                                                                    @endforeach
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <small id="{{ $format->name }}" class="help-block"></small>
                                                    @endif
                                                @endforeach
                                            @else
                                                @if($q->questionType == 'True Or False (Choice)' OR $q->questionType == 'Multiple Choice')
                                                    {{ Form::select(camel_case($q->questionText), ['' => ''] + $q->questionAnswer, null, ['class' => 'form-control fg-input input-sm selectpicker']) }}
                                                @else
                                                    @if($q->questionFormType == 'textarea')
                                                        {{ Form::textarea(camel_case($q->questionText), null, ['class' => 'input-sm form-control fg-input auto-size', 'cols' => '', 'rows' => '', 'placeholder' => $q->questionText]) }}
                                                    @elseif($q->questionFormType == 'date')
                                                        {{ Form::date(camel_case($q->questionText), null, ['class' => 'input-sm form-control fg-input input-mask', 'data-mask' => '0000-00-00', 'placeholder' => $q->questionText]) }}
                                                    @else
                                                        <input name="{{ camel_case($q->questionText) }}" type="{{ $q->questionFormType }}" class="form-control input-sm" placeholder="{{ $q->questionText }}" />
                                                    @endif
                                                @endif
                                                <small id="{{ camel_case($q->questionText) }}" class="help-block"></small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                
                <ul class="fw-footer pagination wizard">
                    <li class="previous"><a class="a-prevent btn btn-icon waves-effect" href="#"><i class="zmdi zmdi-chevron-left"></i></a></li>
                    <li class="next"><a class="a-prevent btn btn-icon waves-effect" href="#"><i class="zmdi zmdi-chevron-right"></i></a></li>
                    <li class="finish"><a class="a-prevent btn btn-icon waves-effect" href="#"><i class="zmdi zmdi-check"></i></a></li>
                </ul>
            </div>
        </div>
        <br />
        <button type="submit" class="hide btnSubmit btn btn-primary btn-block btn-icon-text waves-effect"><i class="zmdi zmdi-square-right"></i>SUBMIT</button>
    </div>
    {{ Form::close() }}
</div>
@endsection

@section('scripts')
<script type="text/javascript">

    var clear = function (create) {
        if(create) {
            $('form').find(':input').trigger('blur');
            $('.selectpicker').selectpicker('deselectAll');
        }
        $('div.form-group').removeClass('has-warning');
        $('small.help-block').text(null);
    };

    var submit = function(target, elm) {
        var status, input = {};
        if(typeof elm === 'undefined') {
            input = $('form').serialize();
        } else {
            $.each(elm.find(':input'), function(k, v) {
                input[v.name] = v.value;
            });
        }
        
        $.ajax((target) ? target : $('form').attr('action'), {
            method: $('form').attr('method'),
            data: input,
            async: false,
            success: function() {
                clear(true);
                status = true;
            },
            error: function(response) {
                notify('Oh snap! Change a few things up and try submitting again. ', 'danger');
                $.each(response.responseJSON, function (k, v) {
                    $('#' + k).parents('div.form-group').addClass('has-warning');
                    $('#' + k).text(v);
                });

                status = false;
            }
        });
      
        return status;
    };


    $('.form-wizard-audience').bootstrapWizard({
        tabClass: 'fw-nav',
        nextSelector: '.next',
        previousSelector: '.previous',
        onTabClick: function (tab) {
            return submit('validate', $(tab.children('a').attr('href')));
        },
        onNext: function (tab) {
            return submit('validate', $(tab.children('a').attr('href')));
        },
        onPrevious: function () {
            clear(false);
        },
        onFinish: function(tab) {
            if(submit('validate', $(tab.children('a').attr('href')))) {
                $('.btnSubmit').removeClass('hide');
            }
        }
    });

</script>
@stop
