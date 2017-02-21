@extends('vendor.materialAdmin.layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard', 'GMC') }}</li>
    <li>{{ link_to('vehicles/series', 'Series') }}</li>
    <li class="active">Edit</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Edit Series <small>Master data of vehicle series.</small></h2>
        <a href="{{ action('Vehicles\Series@index') }}" class="btn btn-icon pull-right bgm-orange" data-toggle="tooltip" data-placement="left" title="Back">
            <i class="zmdi zmdi-arrow-left"></i>
        </a>
    </div>
    <br />
    <div class="card-body card-padding">
        {{ Form::open(['url' => $target . '/update/' . $series->seriesId . '?token=' . Request::session()->get('api_token'), 'method' => 'patch', 'class' => 'ajaxForm']) }}
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                {{ Form::select('brandId', $brands, $series->brandId, ['class' => 'form-control selectpicker', 'data-live-search' => true, 'title' => 'Select Brands']) }}
                <small id="brandId" class="help-block"></small>
            </div>
        </div>
        <br />
        
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ Form::text('seriesName', $series->seriesName, ['class' => 'form-control fg-input']) }}
                        {{ Form::label('seriesName', 'Series Name', ['class' => 'fg-label']) }}
                    </div>
                    <small id="seriesName" class="help-block"></small>
                </div>
            </div>
        </div>
        <br />
        
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                {{ Form::select('classificationId', $classifications, $series->classificationId, ['class' => 'form-control selectpicker', 'data-live-search' => true, 'title' => 'Select Classifications']) }}
                <small id="classificationId" class="help-block"></small>
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
