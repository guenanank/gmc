@extends('vendor.materialAdmin.layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard', 'GMC') }}</li>
    <li>{{ link_to('masters/activity', 'Activities') }}</li>
    <li class="active">Edit</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Edit Activity <small>Master data of activity.</small></h2>
        <a href="{{ action('Masters\Activity@index') }}" class="btn btn-icon pull-right bgm-orange" data-toggle="tooltip" data-placement="left" title="Back">
            <i class="zmdi zmdi-arrow-left"></i>
        </a>
    </div>
    <br />
    <div class="card-body card-padding">
        {{ Form::model($activity, ['route' => ['activity.update', $activity], 'method' =>'patch', 'class' => 'ajaxForm']) }}
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                {{ Form::select('sourceId', $sources, $activity->sourceId, ['class' => 'form-control selectpicker', 'data-live-search' => true, 'title' => 'Choose Source Data']) }}
                <small id="sourceId" class="help-block"></small>
            </div>
        </div>
        
        <br />
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                {{ Form::select('mediaGroupId', $mediaGroups, $activity->mediaGroupId, ['class' => 'form-control selectpicker', 'data-live-search' => true, 'title' => 'Choose Media Group']) }}
                <small id="mediaGroupId" class="help-block"></small>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ Form::text('activityName', $activity->activityName, ['class' => 'form-control fg-input']) }}
                        {{ Form::label('activityName', 'Activity Name', ['class' => 'fg-label']) }}
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
                        {{ Form::text('activityWhere', $activity->activityWhere, ['class' => 'form-control fg-input']) }}
                        {{ Form::label('activityWhere', 'Activity Location', ['class' => 'fg-label']) }}
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
                        {{ Form::text('activityWhen', $activity->activityWhen, ['class' => 'form-control fg-input input-mask', 'data-mask' => '0000-00-00']) }}
                        {{ Form::label('activityWhen', 'Activity Date', ['class' => 'fg-label']) }}
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
        {{ Form::close() }}
    </div>
</div>
@endsection
