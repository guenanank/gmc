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
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-line">
                    {{ Form::label('clubId', 'CLUB ID', ['class' => 'f-500 c-black']) }}
                    {{ Form::text('clubId', null, ['class' => 'form-control fg-input input-mask', 'data-mask' => '0000-000000']) }}
                    <small id="clubId" class="help-block"></small>
                </div>
            </div>
        </div>
        
        <br />
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
                    {{--*/ $answer = [] /*--}}
                    @foreach($layers as $tabNav)
                        <?php
                            //if($audience->audienceLayers->has($tabNav->layerId)) :
                                $answer[$tabNav->layerId] = $audience->audienceLayers->keyBy('layerId')[$tabNav->layerId]->audienceLayerResponse->toArray();
                                //$answer[$tabNav->layerId] = $audience->audienceLayers;
                            //endif;
                        ?>
                        <li>{{ link_to('#' . camel_case($tabNav->layerName), $tabNav->layerName, ['data-toggle' => 'tab']) }}</li>
                    @endforeach     
                </ul>
                <div class="tab-content">
                    @foreach($layers as $layer)
                        <div class="tab-pane fade {{ $layer->layerId == 1 ? 'active in' : null }}" id="{{ camel_case($layer->layerName) }}">
                            {{ Form::hidden('layerId', $layer->layerId) }}
                            @foreach($layer->questions as $q)
                            <div class="row">
                                <div class="col-sm-offset-1 col-sm-10">
                                    @if(isset($q->master))
                                        @foreach($q->master->masterFormat as $format)
                                            @continue($format->form == false)
                                            @if($q->master->masterUseAPI)
                                                <div class="form-group fg-line">
                                                    <p class="f-500 c-black">{{ ucwords($format->name) }}</p>
                                                    <?php
                                                        $urlAPI = $api . strtolower($q->master->masterNamespaces) . '/' . $format->name . '/lists';
                                                        $target = $format->name != 'media' ? $urlAPI : $urlAPI . '/gmc';
                                                        if($format->nested) :
                                                            $lists = '[]';
                                                        else :
                                                            $lists = $client->options($target, ['query' => ['token' => $token]])->getBody();
                                                        endif;
                                                    ?>
                                                    @if($format->multiple)
                                                        {{ Form::select($format->name . '[]', json_decode($lists), $answer[$layer->layerId][$q->questionId]->{$format->name}, ['class' => 'form-control fg-input input-sm selectpicker', 'id' => $format->name, 'data-live-search' => true, 'multiple' => true, 'data-selected-text-format' => 'count', 'title' => 'Choose ' . $format->name]) }}
                                                    @else
                                                        {{ Form::select($format->name, json_decode($lists), $answer[$layer->layerId][$q->questionId]->{$format->name}, ['class' => 'form-control fg-input input-sm selectpicker', 'id' => $format->name, 'data-live-search' => true, 'title' => 'Choose ' . $format->name]) }}
                                                    @endif
                                                    <small id="{{ $format->name }}" class="help-block"></small>
                                                </div>
                                            @else
                                                <div class="form-group fg-line">
                                                    <p class="f-500 c-black">
                                                        {{ ucwords($q->questionText) }}
                                                        <small class="c-gray">{{ $q->questionDesc }}</small>
                                                    </p>
                                                    
                                                    {{--*/ $model = '\GMC\Models\\' . ucfirst($format->name) /*--}}
                                                    @if($format->multiple)
                                                        {{ Form::select($format->name . '[]', $model::lists(), $answer[$layer->layerId][$q->questionId], ['class' => 'form-control fg-input input-sm selectpicker', 'data-live-search' => 'true', 'multiple' => true, 'data-selected-text-format' => 'count', 'title' => 'Choose ' . $format->name]) }}
                                                    @else
                                                        {{ Form::select($format->name, $model::lists(), $answer[$layer->layerId][$q->questionId], ['class' => 'form-control fg-input input-sm selectpicker', 'data-live-search' => 'true', 'title' => 'Choose ' . $format->name]) }}
                                                    @endif
                                                    <small id="{{ $format->name }}" class="help-block"></small>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="form-group fg-line">
                                            <p class="f-500 c-black">
                                                {{ ucwords($q->questionText) }}
                                                <small class="c-gray">{{ $q->questionDesc }}</small>
                                            </p>
                                            @if($q->questionType == 'True Or False' OR $q->questionType == 'Multiple Choice')
                                                {{ Form::select(camel_case($q->questionText), ['' => ''] + $q->questionAnswer, $answer[$layer->layerId][$q->questionId], ['class' => 'form-control fg-input input-sm selectpicker']) }}
                                            @else
                                                @if($q->questionFormType == 'textarea')
                                                    {{ Form::textarea(camel_case($q->questionText), $answer[$layer->layerId][$q->questionId], ['class' => 'input-sm form-control fg-input auto-size', 'cols' => '', 'rows' => '', 'placeholder' => $q->questionText]) }}
                                                @elseif($q->questionFormType == 'date')
                                                    {{ Form::date(camel_case($q->questionText), $answer[$layer->layerId][$q->questionId], ['class' => 'input-sm form-control fg-input input-mask', 'data-mask' => '0000-00-00', 'placeholder' => $q->questionText]) }}
                                                @else
                                                    <input name="{{ camel_case($q->questionText) }}" type="{{ $q->questionFormType }}" class="form-control input-sm" placeholder="{{ $q->questionText }}" value="{{ $answer[$layer->layerId][$q->questionId] }}" />
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
{{ Html::script('js/ajax-bootstrap-select.min.js') }}
{{ Html::script('js/jquery.bootstrap.wizard.min.js') }}
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