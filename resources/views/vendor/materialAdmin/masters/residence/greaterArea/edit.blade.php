@extends('vendor.layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard', 'GMC') }}</li>
    <li>{{ link_to('country', 'Countries') }}</li>
    <li class="active">Edit</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Create New Countries <small>Master data of education.</small></h2>
        <a href="{{ action('Residence\Country@index') }}" class="btn btn-icon pull-right bgm-orange" data-toggle="tooltip" data-placement="left" title="Back">
            <i class="zmdi zmdi-arrow-left"></i>
        </a>
    </div>
    <br />
    <div class="card-body card-padding">
        {{ Form::model($greaterArea, ['url' => $url, 'method' =>'patch', 'class' => 'ajaxForm']) }}
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ Form::text('countryName', null, ['class' => 'form-control fg-input']) }}
                        {{ Form::label('countryName', 'Country Name', ['class' => 'fg-label']) }}
                    </div>
                    <small id="countryName" class="help-block"></small>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ Form::text('countryCode', null, ['class' => 'form-control fg-input']) }}
                        {{ Form::label('countryCode', 'Country Code', ['class' => 'fg-label']) }}
                    </div>
                    <small id="countryCode" class="help-block"></small>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ Form::text('countryISO3Code', null, ['class' => 'form-control fg-input']) }}
                        {{ Form::label('countryISO3Code', 'Country ISO3 Code', ['class' => 'fg-label']) }}
                    </div>
                    <small id="countryISO3Code" class="help-block"></small>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ Form::text('countryNumCode', null, ['class' => 'form-control fg-input']) }}
                        {{ Form::label('countryNumCode', 'Country Num Code', ['class' => 'fg-label']) }}
                    </div>
                    <small id="countryNumCode" class="help-block"></small>
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
