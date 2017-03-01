@extends('vendor.materialAdmin.layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard/', 'GMC') }}</li>
    <li>{{ link_to('audiences/audience', 'Audience') }}</li>
    <li class="active">Create</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Create New Audience <small>Master data of audience.</small></h2>
        <a href="{{ action('Audiences\Audience@index') }}" class="btn bgm-orange pull-right m-r-10 btn-icon" data-toggle="tooltip" data-placement="left" title="Back">
            <i class="zmdi zmdi-arrow-left"></i>
        </a>
    </div>
    <br />
    {{ Form::open(['route' => 'audience.store', 'class' => 'ajaxForm']) }}
    <div class="card-body card-padding">
        {{ Form::hidden('audienceType', 'manual') }}
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                {{ Form::label('activityId', 'ACTIVITY', ['class' => 'f-500 c-black']) }}
                {{ Form::select('activityId[]', [], null, ['class' => 'form-control fg-input ajax-select', 'multiple' => true, 'data-selected-text-format' => 'count', 'data-live-search' => true, 'title' => 'Choose Activities']) }}
                <small id="activityId" class="help-block"></small>
            </div>
        </div>

        <br />
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-line">
                    {{ Form::label('clubId', 'CLUB ID', ['class' => 'f-500 c-black']) }}
                    {{ Form::text('clubId', null, ['class' => 'form-control fg-input input-mask', 'data-mask' => '0000-000000']) }}
                    <small id="clubId" class="help-block"></small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-line">
                    {{ Form::label('memberId', 'MEMBER ID', ['class' => 'f-500 c-black']) }}
                    {{ Form::text('memberId', null, ['class' => 'form-control fg-input']) }}
                    <small id="memberId" class="help-block"></small>
                </div>
            </div>
        </div>
        @if($layers->isEmpty() == false)
            <div class="form-wizard-audience fw-container">
                <ul class="tab-nav text-center">
                    @foreach($layers as $tabNav)
                    <li>{{ link_to('#' . camel_case($tabNav->layerName), $tabNav->layerName, ['data-toggle' => 'tab']) }}</li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach($layers as $tabContent)
                        <div class="tab-pane fade {{ $tabContent->layerId == 1 ? 'active in' : null }}" id="{{ camel_case($tabContent->layerName) }}">
                        {{ Form::hidden('layerId', $tabContent->layerId) }}
                        @foreach($tabContent->questions as $q)
                            <div class="row">
                                <div class="col-sm-offset-1 col-sm-10">
                                    @if(isset($q->master))
                                        @foreach($q->master->masterFormat as $format)
                                            @continue($format->form == false)
                                            @if($q->master->masterUseAPI)
                                                <div class="form-group fg-line">
                                                    <p class="f-500 c-black">{{ ucwords($format->name) }}</p>
                                                    <?php
                                                        if($q->master->masterName == 'Products') :
                                                            $urlAPI = $api . strtolower($q->master->masterNamespaces) . '/' . strtolower(str_singular($q->master->masterName)) . '/' . strtolower($format->name);
                                                        else :
                                                            $urlAPI = $api . strtolower($q->master->masterNamespaces) . '/' . $format->name . '/lists';
                                                        endif;
                                                        
                                                        if($format->nested) :
                                                            $lists = '[]';
                                                        else :
                                                            $lists = $client->options($urlAPI, ['query' => ['token' => $token]])->getBody();
                                                        endif;
                                                    ?>
                                                    @if($format->multiple)
                                                        {{ Form::select($format->name . '[]', json_decode($lists), null, ['class' => 'form-control fg-input input-sm selectpicker', 'id' => $format->name, 'data-live-search' => true, 'multiple' => true, 'data-selected-text-format' => 'count', 'title' => 'Choose ' . $format->name]) }}
                                                    @else
                                                        {{ Form::select($format->name, json_decode($lists), null, ['class' => 'form-control fg-input input-sm selectpicker', 'id' => $format->name, 'data-live-search' => true, 'title' => 'Choose ' . $format->name]) }}
                                                    @endif
                                                    <small id="{{ $format->name }}" class="help-block"></small>
                                                </div>
                                            @else
                                                <div class="form-group fg-line">
                                                    <p class="f-500 c-black">
                                                        {{ ucwords($q->questionText) }}
                                                        <br /><small class="c-gray">{{ $q->questionDesc }}</small>
                                                    </p>
                                                    
                                                    {{--*/ $model = '\GMC\Models\\' . ucfirst($format->name) /*--}}
                                                    @if($format->multiple)
                                                        {{ Form::select($format->name . '[]', $model::lists(), null, ['class' => 'form-control fg-input input-sm selectpicker', 'data-live-search' => 'true', 'multiple' => true, 'data-selected-text-format' => 'count', 'title' => 'Choose ' . $format->name]) }}
                                                    @else
                                                        {{ Form::select($format->name, $model::lists(), null, ['class' => 'form-control fg-input input-sm selectpicker', 'data-live-search' => 'true', 'title' => 'Choose ' . $format->name]) }}
                                                    @endif
                                                    <small id="{{ $format->name }}" class="help-block"></small>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="form-group fg-line">
                                            <p class="f-500 c-black">
                                                {{ ucwords($q->questionText) }}
                                                <br /><small class="c-gray">{{ $q->questionDesc }}</small>
                                            </p>
                                            @if($q->questionType == 'True Or False' OR $q->questionType == 'Multiple Choice')
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
                                        </div>
                                    @endif
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
            <br />
            <button type="submit" class="hide btnSubmit btn btn-primary btn-block btn-icon-text waves-effect">
                <i class="zmdi zmdi-square-right"></i>SUBMIT
            </button>
        @else
            <br />
            <p class="text-center">No layer questions, please create one {{ link_to('layerQuestion', 'here') }}</p>
        @endif
    </div>
    {{ Form::close() }}
</div>
@endsection

@push('scripts')
{{ Html::script('js/regions.js') }}
<script type="text/javascript">

(function ($) {
    
    $.fn.validateAudience = function (obj) {
        var setting = $.fn.extend({
            target: 'validate',
            data: {},
            callback: function () {}
        }, obj);

        
        var $flag = false;

        this.each(function () {
            var $t = $(this);
            
            if ($.isEmptyObject(setting.data)) {
                $.each($t.find(':input'), function (k, v) {
                    if (v.name.length)
                        setting.data[v.name] = v.value;
                });
            }
            
            var $clear = function (create) {
                if (create) {
                    $('form').find(':input').trigger('blur');
                    $('.selectpicker').selectpicker('deselectAll');
                }
                $('div.form-group').removeClass('has-warning');
                $('small.help-block').text(null);
            };
            
            $.ajaxSetup({
                url: setting.target,
                method: 'POST',
                data: setting.data,
                async: false,
                beforeSend: function () {
                    $('.page-loader').fadeIn();
                    $clear(false);
                },
                statusCode: {
                    200: function (data) {
                        console.log(data);
                        $clear(data.create);
                    },
                    422: function (response) {
                        $.notify({
                            message: 'Oh snap! Change a few things up and try submitting again.'
                        }, {
                            type: 'danger',
                            allow_dismiss: false,
                            label: 'Cancel',
                            className: 'btn-xs btn-inverse',
                            placement: {
                                from: 'top',
                                align: 'right'
                            },
                            delay: 2500,
                            animate: {
                                enter: 'animated bounceIn',
                                exit: 'animated bounceOut'
                            },
                            offset: {
                                x: 20,
                                y: 85
                            }
                        });
                        $.each(response.responseJSON, function (k, v) {
                            $('#' + k).parents('div.form-group').addClass('has-warning');
                            $('#' + k).text(v);
                        });
                    }
                }
            });

            $.ajax().done(function (data, msg, jqXHR) {
                $flag = true;
                setting.callback.call(jqXHR);
                $('.page-loader').fadeOut();
            }).fail(function (jqXHR) {
                $flag = false;
                setting.callback.call(jqXHR);
                $('.page-loader').fadeOut();
            });
            
        });
        
        return $flag;
    };
})(jQuery);

</script>
{{ Html::script('js/jquery.bootstrap.wizard.min.js') }}
{{ Html::script('js/ajax-bootstrap-select.min.js') }}
<script type="text/javascript">
    (function ($) {
        var target = '{{ url("audiences/audience/validate") }}';
        $('.form-wizard-audience').bootstrapWizard({
            tabClass: 'fw-nav',
            nextSelector: '.next',
            previousSelector: '.previous',
            onTabClick: function () {
                return false;
            },
            onNext: function (tab) {
                return $(tab.children('a').attr('href')).validateAudience({
                    target: target
                });
            },
            onPrevious: function () {
                $('div.form-group').removeClass('has-warning');
                $('small.help-block').text(null);
                $('.btnSubmit').addClass('hide');
            },
            onFinish: function (tab) {
                $(tab.children('a').attr('href')).validateAudience({
                    target: target,
                    callback: function () {
                        if (this.status === 200) {
                            $('.btnSubmit').removeClass('hide');
                        }
                    }
                });
            }
        });
        
        $('.ajax-select').selectpicker({liveSearch: true}).ajaxSelectPicker({
            ajax: {
                url: '{{ url("masters/activity/selectpicker") }}',
                data: function () {
                    return {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        activityName: '@{{{q}}}'
                    };
                }
            },
            preprocessData: function(data) {
                return data;
            }
        });

        $(document).bind('ajaxComplete', function () {
            $(':input').not('input[type="hidden"]').val(null);
            $('.selectpicker').selectpicker('deselectAll');
            $('.btnSubmit').addClass('hide');
        });

    })(jQuery);
</script>

@endpush
