@extends('layouts.materialAdmin')

@section('blockHeader')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard/') }}">GMC</a></li>
    <li><a href="{{ url('master/mediaGroup/') }}">Media Group</a></li>
    <li class="active">Edit</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Edit MediaGroup <small>Master data of media groups.</small></h2>
        <a href="{{ action('MediaGroupController@index') }}" class="btn btn-icon pull-right bgm-orange" data-toggle="tooltip" data-placement="left" title="Back">
            <i class="zmdi zmdi-arrow-left"></i>
        </a>
    </div>
    <br />
    {{ Form::model($mediaGroup, ['route' => ['mediaGroup.update', $mediaGroup], 'method' =>'patch', 'class' => 'ajaxForm']) }}
    <div class="card-body card-padding">
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ Form::text('mediaGroupName', $mediaGroup->mediaGroupName, ['class' => 'form-control fg-input']) }}
                        {{ Form::label('mediaGroupName', 'Media Group Name', ['class' => 'fg-label']) }}
                    </div>
                    <small id="mediaGroupName" class="help-block"></small>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        <div class="select">
                            {{ Form::select('mediaGroupSubFrom', [''=>''] + App\MediaGroup::lists('mediaGroupName', 'mediaGroupId')->all(), $mediaGroup->mediaGroupSubFrom, ['class' => 'form-control']) }}
                        </div>
                        {{ Form::label('mediaGroupSubFrom', 'Is Sub Media Group From', ['class' => 'fg-label']) }}
                    </div>
                    <small id="mediaGroupSubFrom" class="help-block"></small>
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
    {{ Form::close() }}
</div>
@endsection
