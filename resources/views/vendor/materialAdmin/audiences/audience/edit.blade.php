@extends('vendor.materialAdmin.layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard', 'GMC') }}</li>
    <li>{{ link_to('audiences/audience', 'Audience') }}</li>
    <li class="active">Edit</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Edit Audience <small>Master data of audience.</small></h2>
        <a href="{{ action('Audiences\Audience@index') }}" class="btn bgm-orange pull-right m-r-10 btn-icon" data-toggle="tooltip" data-placement="left" title="Back">
            <i class="zmdi zmdi-arrow-left"></i>
        </a>
    </div>
    <br />
    {{ Form::model($audience, ['route' => ['audience.update', $audience], 'method' => 'patch', 'class' => 'ajaxForm']) }}
    <div class="card-body card-padding">
        {{ Form::hidden('audienceType', 'manual') }}
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                {{ Form::label('activityId', 'ACTIVITY', ['class' => 'f-500 c-black']) }}
                {{ Form::select('activityId[]', $activities, $audience->audienceActivities->pluck('activityId')->all(), ['class' => 'form-control fg-input selectpicker', 'multiple' => true, 'data-selected-text-format' => 'count', 'data-live-search' => true]) }}
                <small id="activityId" class="help-block"></small>
            </div>
        </div>
        <br />
        
        <div class="form-wizard-audience fw-container">
            <ul class="tab-nav text-center">
                @foreach($layers as $tabNav)
                    <li>{{ link_to('#' . camel_case($tabNav->layerName), $tabNav->layerName, ['data-toggle' => 'tab']) }}</li>
                @endforeach
            </ul>
            <div class="tab-content">
                {{--*/ $response = $audience->audienceLayers->pluck('audienceLayerResponse')->flatten(1)->toArray() /*--}}
                @foreach($layers as $tabContent)
                    <div class="tab-pane fade {{ $tabContent->layerId == 1 ? 'active in' : null }}" id="{{ camel_case($tabContent->layerName) }}">
                    {{ Form::hidden('layerId', $tabContent->layerId) }}
                    @foreach($tabContent->questions as $q)
                        <div class="row">
                            <div class="col-sm-offset-1 col-sm-10">
                                @if(isset($q->master))
                                    @foreach($q->master->masterFormat as $format)
                                        @continue($format->form == false)
                                        <div class="form-group fg-line">
                                            @if($q->master->masterUseAPI)
                                                <p class="f-500 c-black">{{ ucwords($format->name) }}</p>
                                                <?php
                                                    $url = $api . strtolower($q->master->masterNamespaces) . '/';
                                                    $urlAPI = $url . $format->name . '/lists';
                                                    if($q->master->masterName == 'Products') :
                                                        $urlAPI = $url . strtolower(str_singular($q->master->masterName)) . '/' . strtolower($format->name);
                                                    endif;

                                                    $lists = $client->options($urlAPI, ['query' => ['token' => $token]])->getBody();
                                                    if($format->nested) :
                                                        $lists = '[]';
                                                    endif;
                                                ?>
                                                @if($format->multiple)
                                                    {{ Form::select($format->name . '[]', json_decode($lists), null, ['class' => 'form-control fg-input input-sm selectpicker', 'id' => $format->name, 'data-live-search' => true, 'multiple' => true, 'title' => 'Choose ' . $format->name]) }}
                                                @else
                                                    {{ Form::select($format->name, json_decode($lists), null, ['class' => 'form-control fg-input input-sm selectpicker', 'id' => $format->name, 'data-live-search' => true, 'title' => 'Choose ' . $format->name]) }}
                                                @endif
                                            @else
                                                <p class="f-500 c-black">
                                                    {{ ucwords($q->questionText) }}
                                                    <br /><small class="c-gray">{{ $q->questionDesc }}</small>
                                                </p>
                                                {{--*/ $model = '\GMC\Models\\' . ucfirst($format->name) /*--}}
                                                @if($q->questionType == 'Multiple Choice')
                                                    {{ Form::select($format->name . '[]', $model::lists(), isset($response[$q->questionId]) ? $response[$q->questionId] : [], ['class' => 'form-control fg-input input-sm selectpicker', 'data-live-search' => true, 'multiple' => true, 'title' => 'Choose ' . $format->name]) }}
                                                @else
                                                    {{ Form::select($format->name, $model::lists(), isset($response[$q->questionId]) ? $response[$q->questionId] : [], ['class' => 'form-control fg-input input-sm selectpicker', 'data-live-search' => 'true', 'title' => 'Choose ' . $format->name]) }}
                                                @endif
                                            @endif
                                            <small id="{{ $format->name }}" class="help-block"></small>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="form-group fg-line">
                                        <p class="f-500 c-black">
                                            {{ ucwords($q->questionText) }}
                                            <br /><small class="c-gray">{{ $q->questionDesc }}</small>
                                        </p>
                                        @if($q->questionType == 'True Or False')
                                            {{ Form::select(camel_case($q->questionText), $q->questionAnswer, isset($response[$q->questionId]) ? $response[$q->questionId] : [], ['class' => 'form-control fg-input input-sm selectpicker', 'title' => 'Choose ' . $q->questionText, 'data-live-search' => true]) }}
                                        @elseif($q->questionType == 'Multiple Choice')
                                            {{ Form::select(camel_case($q->questionText) . '[]', $q->questionAnswer, isset($response[$q->questionId]) ? $response[$q->questionId] : [], ['class' => 'form-control fg-input input-sm selectpicker', 'data-live-search' => true, 'multiple' => true, 'title' => 'Choose ' . $q->questionText]) }}
                                        @else
                                            @if($q->questionFormType == 'textarea')
                                                {{ Form::textarea(camel_case($q->questionText), isset($response[$q->questionId]) ? $response[$q->questionId] : 'Kosong', ['class' => 'input-sm form-control fg-input auto-size', 'cols' => '', 'rows' => '', 'placeholder' => $q->questionText]) }}
                                            @elseif($q->questionFormType == 'date')
                                                {{ Form::date(camel_case($q->questionText), isset($response[$q->questionId]) ? $response[$q->questionId] : 'Kosong', ['class' => 'input-sm form-control fg-input input-mask', 'data-mask' => '0000-00-00', 'placeholder' => $q->questionText]) }}
                                            @else
                                                <input name="{{ camel_case($q->questionText) }}" type="{{ $q->questionFormType }}" class="form-control input-sm" placeholder="{{ $q->questionText }}" value="{{ isset($response[$q->questionId]) ? $response[$q->questionId] : 'Kosong' }}" />
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
    </div>
    {{ Form::close() }}
</div>
@endsection

@push('scripts')
{{ Html::script('js/regions.js') }}
{{ Html::script('js/ajax-bootstrap-select.min.js') }}
{{ Html::script('js/jquery.bootstrap.wizard.min.js') }}
<script type="text/javascript">
    
(function ($) {
    
    var target = '{{ url("audiences/audience/validate") }}';
    $('.form-wizard-audience').bootstrapWizard({
        tabClass: 'fw-nav',
        nextSelector: '.next',
        previousSelector: '.previous',
        onNext: function (tab) {
            return $(tab.children('a').attr('href')).validateAudience({
                target: target
            });
        },
        onPrevious: function () {
            $('.selectpicker').selectpicker('render');
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

    $(document).bind('ajaxComplete', function() {
        $(':input').not('input[type="hidden"]').val(null);
        $('.selectpicker').selectpicker('refresh');
        $('.btnSubmit').addClass('hide');
    });

})(jQuery);
</script>
@endpush