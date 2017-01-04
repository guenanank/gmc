@extends('vendor.materialAdmin.layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard', 'GMC') }}</li>
    <li>{{ link_to('audience', 'Audience') }}</li>
    <li class="active">Edit</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Edit Audience <small>Master data of audience.</small></h2>
        <a href="{{ action('Audience@index') }}" class="btn bgm-orange pull-right m-r-10 btn-icon" data-toggle="tooltip" data-placement="left" title="Back">
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
                {{ Form::select('activityId[]', $activities, $audience->activities->pluck('activityId')->all(), ['class' => 'form-control fg-input selectpicker', 'multiple' => true, 'data-selected-text-format' => 'count', 'data-live-search' => true]) }}
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
        
        <div class="form-wizard-audience fw-container">
            <ul class="tab-nav text-center">
                @foreach($audience->layers as $tabNav)
                    <li>{{ link_to('#' . camel_case($tabNav->layerName), $tabNav->layerName, ['data-toggle' => 'tab']) }}</li>
                @endforeach
            </ul>
            <div class="tab-content">
                @foreach($audience->layers as $tabContent)
                    {{ dd($tabContent) }}
                @endforeach
            </div>
            <ul class="fw-footer pagination wizard">
                <li class="previous"><a class="a-prevent btn btn-icon waves-effect" href="#"><i class="zmdi zmdi-chevron-left"></i></a></li>
                <li class="next"><a class="a-prevent btn btn-icon waves-effect" href="#"><i class="zmdi zmdi-chevron-right"></i></a></li>
                <li class="finish"><a class="a-prevent btn btn-icon waves-effect" href="#"><i class="zmdi zmdi-check"></i></a></li>
            </ul>
        </div>
        <br />
        <button type="submit" class="hide btnSubmit btn btn-primary btn-block btn-icon-text waves-effect"><i class="zmdi zmdi-square-right"></i>SUBMIT</button>
    </div>
    {{ Form::close() }}
</div>
@endsection

@push('scripts')
{{ Html::script('js/regions.js') }}
{{ Html::script('js/jquery.bootstrap.wizard.min.js') }}
{{ Html::script('js/validateAudience.js') }}
<script type="text/javascript">
    (function ($) {
        var target = '{{ url("audience/validate") }}';
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

        $(document).bind('ajaxComplete', function() {
            $('.btnSubmit').addClass('hide');
        });

    })(jQuery);
</script>
@endpush