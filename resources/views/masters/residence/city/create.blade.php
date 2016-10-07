@extends('layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard', 'GMC') }}</li>
    <li>{{ link_to('city', 'Cities') }}</li>
    <li class="active">Create</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Create New Cities <small>Master data of city.</small></h2>
        <a href="{{ action('Residence\CityController@index') }}" class="btn btn-icon pull-right bgm-orange" data-toggle="tooltip" data-placement="left" title="Back">
            <i class="zmdi zmdi-arrow-left"></i>
        </a>
    </div>
    <br />
    <div class="card-body card-padding">
        {{ Form::open(['url' => $route, 'class' => 'ajaxForm']) }}
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ Form::text('cityName', null, ['class' => 'form-control fg-input']) }}
                        {{ Form::label('cityName', 'City Name', ['class' => 'fg-label']) }}
                    </div>
                    <small id="cityName" class="help-block"></small>
                </div>
            </div>
        </div>

        <br />
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ Form::select('provinceId', ['' => ''], null, ['class' => 'form-control fg-input']) }}
                        {{ Form::label('provinceId', 'Province', ['class' => 'fg-label']) }}
                    </div>
                    <small id="provinceId" class="help-block"></small>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ Form::select('greaterAreaId', ['' => ''], null, ['class' => 'form-control fg-input']) }}
                        {{ Form::label('greaterAreaId', 'Greater Area', ['class' => 'fg-label']) }}
                    </div>
                    <small id="greaterAreaId" class="help-block"></small>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ Form::text('cityCode', null, ['class' => 'form-control fg-input']) }}
                        {{ Form::label('cityCode', 'City Code', ['class' => 'fg-label']) }}
                    </div>
                    <small id="cityCode" class="help-block"></small>
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
