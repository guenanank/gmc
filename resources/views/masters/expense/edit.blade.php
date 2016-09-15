@extends('layouts.materialAdmin')

@section('blockHeader')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard/') }}">GMC</a></li>
    <li><a href="{{ url('master/expense/') }}">Expense</a></li>
    <li class="active">Edit</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Edit Expense <small>Master data of expense.</small></h2>
        <a href="{{ action('ExpenseController@index') }}" class="btn btn-icon pull-right bgm-orange" data-toggle="tooltip" data-placement="left" title="Back">
            <i class="zmdi zmdi-arrow-left"></i>
        </a>
    </div>
    <br />
    {{ Form::model($expense, ['route' => ['expense.update', $expense], 'method' =>'patch', 'class' => 'ajaxForm']) }}
    <div class="card-body card-padding">
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ Form::text('expenseMin', $expense->expenseMin, ['class' => 'form-control fg-input']) }}
                        {{ Form::label('expenseMin', 'Expense Min', ['class' => 'fg-label']) }}
                    </div>
                    <small id="expenseMin" class="help-block"></small>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ Form::text('expenseMax', $expense->expenseMax, ['class' => 'form-control fg-input']) }}
                        {{ Form::label('expenseMax', 'Expense Max', ['class' => 'fg-label']) }}
                    </div>
                    <small id="expenseMax" class="help-block"></small>
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