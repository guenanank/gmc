@extends('layouts.materialAdmin')

@section('blockHeader')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard', 'GMC') }}</li>
    <li>{{ link_to('interest', 'Interests') }}</li>
    <li class="active">Edit</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Edit Interest <small>Master data of interests.</small></h2>
        <a href="{{ action('InterestController@index') }}" class="btn btn-icon pull-right bgm-orange" data-toggle="tooltip" data-placement="left" title="Back">
            <i class="zmdi zmdi-arrow-left"></i>
        </a>
    </div>
    <br />
    <div class="card-body card-padding">
        {{ Form::model($interest, ['route' => ['interest.update', $interest], 'method' =>'patch', 'class' => 'ajaxForm']) }}
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ Form::text('interestName', $interest->interestName, ['class' => 'form-control fg-input']) }}
                        {{ Form::label('interestName', 'Interest Name', ['class' => 'fg-label']) }}
                    </div>
                    <small id="interestName" class="help-block"></small>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        <div class="select">
                            {{ Form::select('interestSubFrom', [''=>''] + $interests, $interest->interestSubFrom, ['class' => 'form-control']) }}
                        </div>
                        {{ Form::label('interestSubFrom', 'Is Sub Interest From', ['class' => 'fg-label']) }}
                    </div>
                    <small id="interestSubFrom" class="help-block"></small>
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