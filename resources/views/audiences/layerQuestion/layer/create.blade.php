@extends('layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard/') }}">GMC</a></li>
    <li><a href="{{ url('audience/layerQuestion') }}">Layer Question</a></li>
    <li class="active">Create</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Create New Layer Question <small>Master data of audience type.</small></h2>
        <a href="{{ action('LayerController@index') }}" class="btn btn-icon pull-right bgm-orange" data-toggle="tooltip" data-placement="left" title="Back">
            <i class="zmdi zmdi-arrow-left"></i>
        </a>
    </div>
    <br />
    {{ Form::open(['route' => 'layerQuestion.store', 'class' => 'ajaxForm'])}}
    <div class="card-body card-padding">
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ Form::text('layerName', null, ['class' => 'form-control fg-input']) }}
                        {{ Form::label('layerName', 'Layer Name', ['class' => 'fg-label']) }}
                    </div>
                    <small id="layerName" class="help-block"></small>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ Form::textarea('layerDesc', null, ['class' => 'form-control fg-input auto-size', 'cols' => '', 'rows' => '']) }}
                        {{ Form::label('layerDesc', 'Layer Description', ['class' => 'fg-label']) }}
                    </div>
                    <small id="layerDesc" class="help-block"></small>
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
