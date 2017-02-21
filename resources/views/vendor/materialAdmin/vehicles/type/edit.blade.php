@extends('vendor.materialAdmin.layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard', 'GMC') }}</li>
    <li>{{ link_to('vehicles/type', 'Types') }}</li>
    <li class="active">Edit</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Edit Types <small>Master data of vehicle types.</small></h2>
        <a href="{{ action('Vehicles\Type@index') }}" class="btn btn-icon pull-right bgm-orange" data-toggle="tooltip" data-placement="left" title="Back">
            <i class="zmdi zmdi-arrow-left"></i>
        </a>
    </div>
    <br />
    <div class="card-body card-padding">
        {{ Form::open(['url' => $target . '/update/' . $type->typeId . '?token=' . Request::session()->get('api_token'), 'method' => 'patch', 'class' => 'ajaxForm']) }}
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ Form::text('typeName', $type->typeName, ['class' => 'form-control fg-input']) }}
                        {{ Form::label('typeName', 'Type Name', ['class' => 'fg-label']) }}
                    </div>
                    <small id="typeName" class="help-block"></small>
                </div>
            </div>
        </div>
        <br />

        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                {{ Form::select('seriesId', $series, $type->seriesId, ['class' => 'form-control selectpicker', 'data-live-search' => true, 'title' => 'Select Series']) }}
                <small id="seriesId" class="help-block"></small>
            </div>
        </div>
        <br />
        
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ Form::text('typeYear', $type->typeYear, ['class' => 'form-control fg-input']) }}
                        {{ Form::label('typeYear', 'Type Year', ['class' => 'fg-label']) }}
                    </div>
                    <small id="typeYear" class="help-block"></small>
                </div>
            </div>
        </div>
        <br />
        
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ Form::text('typeCc', $type->typeCc, ['class' => 'form-control fg-input']) }}
                        {{ Form::label('typeCc', 'Types CC', ['class' => 'fg-label']) }}
                    </div>
                    <small id="typeCc" class="help-block"></small>
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
