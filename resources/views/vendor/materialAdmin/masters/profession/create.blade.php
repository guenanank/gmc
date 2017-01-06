@extends('vendor.materialAdmin.layouts.materialAdmin')

@section('blockHeader')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard', 'GMC') }}</li>
    <li>{{ link_to('masters/profession', 'Profession') }}</li>
    <li class="active">Create</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Create New Profession <small>Master data of profession.</small></h2>
        <a href="{{ action('Masters\Profession@index') }}" class="btn btn-icon pull-right bgm-orange" data-toggle="tooltip" data-placement="left" title="Back">
            <i class="zmdi zmdi-arrow-left"></i>
        </a>
    </div>
    <br />
    <div class="card-body card-padding">
        {{ Form::open(['route' => 'profession.store', 'class' => 'ajaxForm']) }}
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ Form::text('professionName', null, ['class' => 'form-control fg-input']) }}
                        {{ Form::label('professionName', 'Profession Name', ['class' => 'fg-label']) }}
                    </div>
                    <small id="professionName" class="help-block"></small>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        <div class="select">
                            {{ Form::select('professionSubFrom', $professions, null, ['class' => 'form-control']) }}
                        </div>
                        {{ Form::label('professionSubFrom', 'Is Sub Profession From', ['class' => 'fg-label']) }}
                    </div>
                    <small id="professionSubFrom" class="help-block"></small>
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