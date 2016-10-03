@extends('layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard/') }}">GMC</a></li>
    <li class="active">Hobbies</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Hobbies <small>Master data of hobbies.</small></h2>
        <a href="{{ action('HobbyController@create') }}" class="btn btn-icon pull-right bgm-green" data-toggle="tooltip" data-placement="left" title="Create New Hobby">
            <i class="add-new-item zmdi zmdi-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table id="bootgrid" class="table table-hover table-condensed table-vmiddle" data-url="{{ route('hobby.bootgrid') }}">
            <thead>
                <tr>
                    <th data-column-id="hobbyName" data-type="string" data-identifier="true">Name</th>
                    <th data-column-id="hobbySubFrom" data-formatter="hobbySubFrom" data-type="string">Is Sub From</th>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('scripts')
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
            hobbySubFrom: function (column, row) {
                if (row.parent)
                    return row.parent.hobbyName;
            },
            commands: function (column, row) {
                return '<a href="{{ url("hobby") }}/' + row.hobbyId + '/edit" class="btn btn-icon bgm-blue command-edit" title="Edit ' + row.hobbyName + '"><span class="zmdi zmdi-edit"></span></a>&nbsp; ' +
                        '<button type="button" class="btn btn-icon bgm-red command-delete" data-row-id="' + row.hobbyId + '" title="Delete ' + row.hobbyName + '"><span class="zmdi zmdi-delete"></span></button>';
            }
        }
    }).on('loaded.rs.jquery.bootgrid', function () {
        $('#bootgrid').find('.command-delete').on('click', function (e) {
            e.preventDefault();
            deletes('hobby', $(this).data('row-id'));
        });
    });
})(jQuery);
</script>
@stop