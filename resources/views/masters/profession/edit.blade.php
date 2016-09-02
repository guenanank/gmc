@extends('layouts.materialAdmin')

@section('blockHeader')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard/') }}">GMC</a></li>
    <li><a href="{{ url('master/profession/') }}">Profession</a></li>
    <li class="active">Edit</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Edit Profession <small>Master data of professions.</small></h2>
        <a href="{{ action('ProfessionController@index') }}" class="btn btn-icon pull-right bgm-orange" data-toggle="tooltip" data-placement="left" title="Back">
            <i class="zmdi zmdi-arrow-left"></i>
        </a>
    </div>
    <br />
    {!! Form::model($profession, ['route' => ['master.profession.update', $profession], 'method' =>'patch', 'class' => 'ajaxForm']) !!}
    <div class="card-body card-padding">
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {!! Form::text('professionName', $profession->professionName, ['class' => 'form-control fg-input']) !!}
                        {!! Form::label('professionName', 'Profession Name', ['class' => 'fg-label']) !!}
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
                            {!! Form::select('professionSubFrom', ['' => ''] + App\Profession::lists('professionName', 'professionId')->all(), $profession->professionSubFrom, ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::label('professionSubFrom', 'Is Sub Profession From', ['class' => 'fg-label']) !!}
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
    </div>
    {!! Form::close() !!}
</div>
@endsection
