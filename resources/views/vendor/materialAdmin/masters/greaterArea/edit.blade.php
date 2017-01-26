@extends('vendor.materialAdmin.layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard', 'GMC') }}</li>
    <li>{{ link_to('masters/greaterArea', 'Greater Areas') }}</li>
    <li class="active">Edit</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Edit Greater Areas <small>Master data of greaterArea.</small></h2>
        <a href="{{ action('Masters\GreaterArea@index') }}" class="btn btn-icon pull-right bgm-orange" data-toggle="tooltip" data-placement="left" title="Back">
            <i class="zmdi zmdi-arrow-left"></i>
        </a>
    </div>
    <br />
    <div class="card-body card-padding">
        {{ Form::open(['url' => $target . '/update/' . $greaterArea->greaterAreaId . '?token=' . Request::session()->get('api_token'), 'method' => 'patch', 'class' => 'ajaxForm']) }}
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ Form::text('greaterAreaName', $greaterArea->greaterAreaName, ['class' => 'form-control fg-input']) }}
                        {{ Form::label('greaterAreaName', 'Greater Area Name', ['class' => 'fg-label']) }}
                    </div>
                    <small id="greaterAreaName" class="help-block"></small>
                </div>
            </div>
        </div>
        <br />

        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                {{ Form::select('regencyId[]', $regencies, collect($greaterArea->regencies)->pluck('regencyId')->all(), ['class' => 'form-control selectpicker', 'multiple' => true, 'data-selected-text-format' => 'count', 'data-live-search' => true, 'title' => 'Select Regencies']) }}
                <small id="regencyId" class="help-block"></small>
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
