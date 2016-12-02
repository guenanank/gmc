@extends('vendor.materialAdmin.layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard', 'GMC') }}</li>
    <li>{{ link_to('layerQuestion', 'Layer Questions') }}</li>
    <li class="active">Questions</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        {{ Form::hidden('layerId', $layer->layerId) }}
        <h2>{{ $layer->layerName }} Layer Question<small>Master data of {{ strtolower($layer->layerName) }} layer question.</small></h2>
        <a class="btn bgm-green pull-right btn-icon create" data-toggle="tooltip" data-placement="top" title="Create New Layer Questions">
            <i class="zmdi zmdi-plus"></i>
        </a>
        <a href="{{ action('Layer@index') }}" class="btn bgm-orange pull-right m-r-10 btn-icon" data-toggle="tooltip" data-placement="left" title="Back">
            <i class="zmdi zmdi-arrow-left"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table id="bootgrid" class="table table-striped table-condensed table-vmiddle" data-url="{{ route('question.bootgrid') }}">
            <thead>
                <tr>
                    <th data-column-id="questionId" data-type="numeric" data-formatter="iD" data-identifier="true">#Id</th>
                    <th data-column-id="questionType" data-type="string">Type</th>
                    <th data-column-id="masterId" data-formatter="master" data-type="string">Use Master</th>
                    <th data-column-id="questionText" data-formatter="text" data-type="string">Text/Answer</th>
                    <th data-column-id="questionDesc" data-type="string">Description</th>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@include('vendor.materialAdmin.audiences.layerQuestion.question.create')

@endsection

@push('scripts')
{{ Html::script('js/question.js') }}
@endpush