@extends('vendor.materialAdmin.layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard', 'GMC') }}</li>
    <li>{{ link_to('vehicles/classification', 'Classifications') }}</li>
    <li class="active">Edit</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Edit Classifications <small>Master data of vehicle classification.</small></h2>
        <a href="{{ action('Vehicles\Classification@index') }}" class="btn btn-icon pull-right bgm-orange" data-toggle="tooltip" data-placement="left" title="Back">
            <i class="zmdi zmdi-arrow-left"></i>
        </a>
    </div>
    <br />
    <div class="card-body card-padding">
        {{ Form::open(['url' => $target . '/update/' . $classification->classificationId . '?token=' . Request::session()->get('api_token'), 'method' => 'patch', 'class' => 'ajaxForm']) }}
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ Form::text('classificationName', $classification->classificationName, ['class' => 'form-control fg-input']) }}
                        {{ Form::label('classificationName', 'Greater Area Name', ['class' => 'fg-label']) }}
                    </div>
                    <small id="classificationName" class="help-block"></small>
                </div>
            </div>
        </div>
        <br />

        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ Form::textarea('classificationDesc', $classification->classificationDesc, ['class' => 'form-control fg-input auto-size', 'cols' => '', 'rows' => '']) }}
                        {{ Form::label('classificationDesc', 'Classification Description', ['class' => 'fg-label']) }}
                    </div>
                    <small id="classificationDesc" class="help-block"></small>
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
