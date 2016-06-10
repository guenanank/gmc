@extends('layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard/') }}">GMC</a></li>
    <li><a href="{{ url('master/activity') }}">Activity</a></li>
    <li class="active">Create</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Create New Activity <small>Master data of activity.</small></h2>
        <a href="{{ action('ActivityController@index') }}" class="btn btn-float bgm-lightblue waves-circle" data-toggle="tooltip" data-placement="left" title="Back">
            <i class="zmdi zmdi-arrow-left"></i>
        </a>
    </div>
    <br />
    {!! Form::open(['route' => 'master.activity.store'])!!}
    <div class="card-body card-padding">
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        <div class="select">
                            {!! Form::select('sourceId', [''=>''] + App\Source::lists('sourceName', 'sourceId')->all(), null, ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::label('sourceId', 'Choose Source Data', ['class' => 'fg-label']) !!}
                    </div>
                    <small id="sourceId" class="help-block"></small>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        <div class="select">
                            {!! Form::select('mediaGroupId', [''=>''] + App\MediaGroup::where('mediaGroupSubFrom', '!=', 0)->lists('mediaGroupName', 'mediaGroupId')->all(), null, ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::label('mediaGroupId', 'Choose Media Group', ['class' => 'fg-label']) !!}
                    </div>
                    <small id="mediaGroupId" class="help-block"></small>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {!! Form::text('activityName', null, ['class' => 'form-control fg-input']) !!}
                        {!! Form::label('activityName', 'Activity Name', ['class' => 'fg-label']) !!}
                    </div>
                    <small id="activityName" class="help-block"></small>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {!! Form::text('activityWhere', null, ['class' => 'form-control fg-input']) !!}
                        {!! Form::label('activityWhere', 'Activity Location', ['class' => 'fg-label']) !!}
                    </div>
                    <small id="activityWhere" class="help-block"></small>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {!! Form::text('activityWhen', null, ['class' => 'form-control fg-input input-mask', 'data-mask' => '0000-00-00']) !!}
                        {!! Form::label('activityWhen', 'Activity Date', ['class' => 'fg-label']) !!}
                    </div>
                    <small id="activityWhen" class="help-block"></small>
                </div>
            </div>
        </div>
        <br />
        
        <div class="form-group">
            <div class="col-sm-offset-1 col-sm-10">
                <button class="btn btn-primary btn-icon-text btn-sm waves-effect" type="submit">
                    <i class="zmdi zmdi-check"></i> Save
                </button>
            </div>
        </div>
        <br />
    </div>
    {!! Form::close() !!}
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $('form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: $('form').attr('action'),
            data: {
                sourceId: $('select[name="sourceId"]').val(),
                mediaGroupId: $('select[name="mediaGroupId"]').val(),
                activityName: $('input[name="activityName"]').val(),
                activityWhere: $('input[name="activityWhere"]').val(),
                activityWhen: $('input[name="activityWhen"]').val()
            },
            success: function () {
                swal({
                    title: 'Success!',
                    text: 'Data Saved.',
                    type: 'success',
                    showConfirmButton: false,
                    timer: 2000
                });
                $('div.form-group').removeClass('has-warning');
                $('small.help-block').text(null);
                $('input[type="text"], select').val(null).blur();
            },
            error: function (response) {
                $.each($.parseJSON(response.responseText), function (k, v) {
                    $('#' + k).parents('div.form-group').addClass('has-warning');
                    $('#' + k).text(v);
                });
            }
        });
    });
</script>
@stop