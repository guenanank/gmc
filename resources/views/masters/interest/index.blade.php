@extends('layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard/') }}">GMC</a></li>
    <li class="active">Interests</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Interests <small>Master data of interests.</small></h2>
        <a href="{{ action('InterestController@create') }}" class="btn btn-icon pull-right bgm-green" data-toggle="tooltip" data-placement="left" title="Create New Interest">
            <i class="add-new-item zmdi zmdi-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table id="bootgrid" class="table table-hover table-condensed table-vmiddle" data-url="{{ route('interest.bootgrid') }}">
            <thead>
                <tr>
                    <th data-column-id="interestName" data-type="string" data-identifier="true">Name</th>
                    <th data-column-id="interestSubFrom" data-formatter="interestSubFrom" data-type="string">Is Sub From</th>
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
            interestSubFrom: function (column, row) {
                if (row.parent)
                    return row.parent.interestName;
            },
            commands: function (column, row) {
                return '<a href="{{ url("interest") }}/' + row.interestId + '/edit" class="btn btn-icon bgm-blue command-edit" title="Edit ' + row.interestName + '"><span class="zmdi zmdi-edit"></span></a>&nbsp; ' +
                        '<button type="button" class="btn btn-icon bgm-red command-delete" data-row-id="' + row.interestId + '" title="Delete ' + row.interestName + '"><span class="zmdi zmdi-delete"></span></button>';
            }
        }
    }).on('loaded.rs.jquery.bootgrid', function () {
        $('#bootgrid').find('.command-delete').on('click', function (e) {
            e.preventDefault();
            deletes('interest', $(this).data('row-id'));
        });
    });
})(jQuery);
</script>
@stop