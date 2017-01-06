@extends('vendor.materialAdmin.layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard', 'GMC') }}</li>
    <li class="active">Expenses</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Expense <small>Master data of expense.</small></h2>
        <a href="{{ action('Masters\Expense@create') }}" class="btn btn-icon pull-right bgm-green" data-toggle="tooltip" data-placement="left" title="Create New Expenses">
            <i class="add-new-item zmdi zmdi-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table id="bootgrid" class="table table-hover table-condensed table-vmiddle" data-url="{{ route('expense.bootgrid') }}">
            <thead>
                <tr>
                    <th data-column-id="expenseMin" data-formatter="expenseMin" data-type="string" data-identifier="true">Minimum</th>
                    <th data-column-id="expenseMax" data-formatter="expenseMax" data-type="string">Maximum</th>
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
            caseSensitive: false,
            ajax: true,
            selection: true,
            rowCount: [5, 10, 25, 50, -1],
            multiSelect: true,
            rowSelect: true,
            keepSelection: true,
            url: $('#bootgrid').data('url'),
            css: {
                icon: 'zmdi icon',
                iconColumns: 'zmdi-view-module',
                iconDown: 'zmdi-sort-desc',
                iconUp: 'zmdi-sort-asc',
                iconRefresh: 'zmdi-refresh'
            },
            formatters: {
                expenseMin: function (column, row) {
                    return row.expenseMin.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                },
                expenseMax: function (column, row) {
                    return row.expenseMax.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                },
                commands: function (column, row) {
                    var btnEdit = '<a href="{{ url("masters/expense") }}/' + row.expenseId + '/edit" class="btn btn-icon bgm-blue command-edit" title="Edit Expense"><span class="zmdi zmdi-edit"></span></a>&nbsp; ';
                    var btnDelete = '<button type="button" class="btn btn-icon bgm-red command-delete" data-row-id="' + row.expenseId + '" title="Delete Expense"><span class="zmdi zmdi-delete"></span></button>';
                    return btnEdit + btnDelete;
                }
            }
        }).on('loaded.rs.jquery.bootgrid', function () {
            $('#bootgrid').find('.command-delete').on('click', function (e) {
                e.preventDefault();
                var expenseId = $(this).data('row-id');
                $(this).ajaxDelete({
                    url: 'expense/' + expenseId
                });
            });
        });
    })(jQuery);
</script>
@endpush