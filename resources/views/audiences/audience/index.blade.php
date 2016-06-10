@extends('layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard/') }}">GMC</a></li>
    <li class="active">Audiences</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Audiences <small>Master data of audience.</small></h2>
        <a href="{{ action('AudienceController@create') }}" class="btn btn-float bgm-lightblue waves-circle" data-toggle="tooltip" data-placement="left" title="Create New Audiencess">
            <i class="add-new-item zmdi zmdi-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table id="bootgrid" class="table table-hover table-condensed table-vmiddle" data-url="{{ url('audience/audience/bootgrid') }}">
            <thead>
                <tr>
                    <th data-column-id="audienceFullname" data-type="string" data-identifier="true">Fullname</th>
                    <th data-column-id="audienceNickname" data-type="string" data-identifier="true">Nickname</th>
                    <th data-column-id="audienceGender" data-type="string" data-identifier="true">Gender</th>
                    <th data-column-id="audienceDoB" data-type="string" data-identifier="true">Date of Birth</th>
                    <th data-column-id="audienceBirthPlace" data-type="string" data-identifier="true">Birthplace</th>
                    <th data-column-id="audienceAddress" data-type="string" data-identifier="true">Address</th>
                    <th data-column-id="audiencePhone" data-type="string" data-identifier="true">Phone</th>
                    <th data-column-id="audienceHandphone" data-type="string" data-identifier="true">Handphone</th>
                    <th data-column-id="audienceEmail" data-type="string" data-identifier="true">Email</th>
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
            commands: function (column, row) {
                return '<a href="{{ url("audience/audience") }}/' + row.audienceId + '/edit" class="btn btn-icon c-blue command-edit waves-effect waves-circle" title="Edit ' + row.audienceFullname + '"><span class="zmdi zmdi-edit"></span></a>&nbsp; ' +
                        '<button type="button" class="btn btn-icon c-red command-delete waves-effect waves-circle" data-row-id="' + row.audienceId + '" title="Delete ' + row.audienceFullname + '"><span class="zmdi zmdi-delete"></span></button>';
            }
        }
    }).on('loaded.rs.jquery.bootgrid', function () {
        $('#bootgrid').find('.command-delete').on('click', function (e) {
            var audienceId = $(this).data('row-id');
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
                $.post('audience/' + audienceId, {_method: 'DELETE'}, function () {
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