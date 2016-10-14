@extends('layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard', 'GMC') }}</li>
    <li class="active">Layer Questions</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Layer Questions <small>Master data of layer question.</small></h2>
        <a href="{{ action('Layer@create') }}" class="btn btn-icon pull-right bgm-green" data-toggle="tooltip" data-placement="left" title="Create New Layer Questions">
            <i class="zmdi zmdi-plus"></i>
        </a>

        <a href="{{ route('upload.download') }}" class="btn bgm-teal btn-icon pull-right m-r-10" data-toggle="tooltip" data-placement="top" title="Sample upload format">
            <i class="zmdi zmdi-download"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table id="bootgrid" class="table table-striped table-condensed table-vmiddle" data-url="{{ route('layerQuestion.bootgrid') }}">
            <thead>
                <tr>
                    <th data-column-id="layerName" data-type="string" data-identifier="true">Layer Name</th>
                    <th data-column-id="layerDesc" data-type="string">Layer Description</th>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    (function ($) {
        $('#bootgrid').bootgrid({
            ajax: true,
            selection: true,
            rowCount: [5, 10, 25, 50, -1],
            multiSelect: true,
            rowSelect: true,
            keepSelection: true,
            caseSensitive: false,
            url: $('#bootgrid').data('url'),
            css: {
                icon: 'zmdi icon',
                iconColumns: 'zmdi-view-module',
                iconDown: 'zmdi-sort-desc',
                iconUp: 'zmdi-sort-asc',
                iconRefresh: 'zmdi-refresh'
            },
            formatters: {
                commands: function (column, row) {
                    var questionList = '<a href="{{ url("layerQuestion") }}/l/' + row.layerId + '" data-toggle="tooltip" class="btn btn-icon bgm-amber" title="' + row.layerName + ' Question List"><span class="zmdi zmdi-view-list-alt"></span></a>&nbsp;';
                    var edit = '<a href="{{ url("layerQuestion") }}/' + row.layerId + '/edit" data-toggle="tooltip" class="btn btn-icon bgm-blue command-edit" title="Edit ' + row.layerName + '"><span class="zmdi zmdi-edit"></span></a>&nbsp;';
                    var del = '<button data-toggle="tooltip" class="btn btn-icon bgm-red command-delete" data-row-id="' + row.layerId + '" title="Delete ' + row.layerName + '"><span class="zmdi zmdi-delete"></span></button>';
                    return  questionList + edit + del;
                }
            }
        }).on('loaded.rs.jquery.bootgrid', function () {
            $('#bootgrid').find('.command-delete').on('click', function (e) {
                e.preventDefault();
                deletes('layerQuestion', $(this).data('row-id'));
            });
        });
    })(jQuery);
</script>
@endpush