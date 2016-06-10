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
        <a href="{{ action('HobbyController@create') }}" class="btn btn-float bgm-lightblue waves-circle" data-toggle="tooltip" data-placement="left" title="Create New Hobby">
            <i class="add-new-item zmdi zmdi-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table id="bootgrid" class="table table-hover table-condensed table-vmiddle" data-url="{{ url('master/hobby/bootgrid') }}">
            <thead>
                <tr>
                    <th data-column-id="hobbyName" data-type="string" data-identifier="true">Hobby Name</th>
                    <th data-column-id="hobbySubFrom" data-formatter="hobbySubFrom" data-type="string">Is Sub Hobby From</th>
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
            iconDown: 'zmdi-caret-down',
            iconUp: 'zmdi-caret-up',
            iconRefresh: 'zmdi-refresh'
        },
        formatters: {
            hobbySubFrom: function (column, row) {
                if (row.parent)
                    return row.parent.hobbyName;
            },
            commands: function (column, row) {
                return '<a href="{{ url("master/hobby") }}/' + row.hobbyId + '/edit" class="btn btn-icon c-blue command-edit waves-effect waves-circle" title="Edit ' + row.hobbyName + '"><span class="zmdi zmdi-edit"></span></a>&nbsp; ' +
                        '<button type="button" class="btn btn-icon c-red command-delete waves-effect waves-circle" data-row-id="' + row.hobbyId + '" title="Delete ' + row.hobbyName + '"><span class="zmdi zmdi-delete"></span></button>';
            }
        }
    }).on('loaded.rs.jquery.bootgrid', function () {
        $('#bootgrid').find('.command-delete').on('click', function (e) {
            var hobbyId = $(this).data('row-id');
            e.preventDefault();
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                $.post('hobby/' + hobbyId, {_method: 'DELETE'}, function () {
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