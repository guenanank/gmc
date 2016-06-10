@extends('layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard/') }}">GMC</a></li>
    <li class="active">Expense</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Expense <small>Master data of expense.</small></h2>
        <a href="{{ action('ExpenseController@create') }}" class="btn btn-float bgm-lightblue waves-circle" data-toggle="tooltip" data-placement="left" title="Create New Expenses">
            <i class="add-new-item zmdi zmdi-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table id="bootgrid" class="table table-hover table-condensed table-vmiddle" data-url="{{ url('master/expense/bootgrid') }}">
            <thead>
                <tr>
                    <th data-column-id="expenseMin" data-formatter="expenseMin" data-type="string" data-identifier="true">Expense Min</th>
                    <th data-column-id="expenseMax" data-formatter="expenseMax" data-type="string">Expense Max</th>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">

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
            iconDown: 'zmdi-caret-down',
            iconUp: 'zmdi-caret-up',
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
                return '<a href="{{ url("master/expense") }}/' + row.expenseId + '/edit" class="btn btn-icon c-blue command-edit waves-effect waves-circle" title="Edit Expense"><span class="zmdi zmdi-edit"></span></a>&nbsp; ' +
                        '<button type="button" class="btn btn-icon c-red command-delete waves-effect waves-circle" data-row-id="' + row.expenseId + '" title="Delete Expense"><span class="zmdi zmdi-delete"></span></button>';
            }
        }
    }).on('loaded.rs.jquery.bootgrid', function () {
        $('#bootgrid').find('.command-delete').on('click', function (e) {
            e.preventDefault();
            var expenseId = $(this).data('row-id');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                $.post('expense/' + expenseId, {_method: 'DELETE'}, function () {
                    swal({
                        title: 'Deleted!',
                        text: 'Your file has been deleted.',
                        type: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    $('#bootgrid').bootgrid('reload');
                });
            });
        });
    });
</script>
@stop