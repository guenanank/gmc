@extends('layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard/') }}">GMC</a></li>
    <li class="active">Activity</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Activity <small>Master data of activity.</small></h2>
        <a href="{{ action('ActivityController@create') }}" class="btn btn-float bgm-lightblue waves-circle" data-toggle="tooltip" data-placement="left" title="Create New Activities">
            <i class="add-new-item zmdi zmdi-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table id="bootgrid" class="table table-hover table-condensed table-vmiddle" data-url="{{ url('master/activity/bootgrid') }}">
            <thead>
                <tr>
                    <th data-column-id="activityName" data-type="string" data-identifier="true">Activity Name</th>
                    <th data-column-id="activityWhere" data-type="string">Activity Location</th>
                    <th data-column-id="activityWhen" data-converter="datetime" data-type="date">Activity Date</th>
                    <th data-column-id="sourceId" data-formatter="source" data-type="string">Source</th>
                    <th data-column-id="mediaGroupId" data-formatter="mediaGroup" data-type="string">Media Group</th>
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
        converters: {
            datetime: {
                from: function (value) {
                    return moment(value);
                },
                to: function (value) {
                    return moment(value).format('LL');
                }
            }
        },
        formatters: {
            source: function (column, row) {
                return row.source.sourceName;
            },
            mediaGroup: function (column, row) {
                return row.media_group.mediaGroupName;
            },
            commands: function (column, row) {
                return '<a href="{{ url("master/activity") }}/' + row.activityId + '/edit" class="btn btn-icon c-blue command-edit waves-effect waves-circle" title="Edit ' + row.activityName + '"><span class="zmdi zmdi-edit"></span></a>&nbsp; ' +
                        '<button type="button" class="btn btn-icon c-red command-delete waves-effect waves-circle" data-row-id="' + row.activityId + '" title="Delete ' + row.activityName + '"><span class="zmdi zmdi-delete"></span></button>';
            }
        }
    }).on('loaded.rs.jquery.bootgrid', function () {
        $('#bootgrid').find('.command-delete').on('click', function (e) {
            var activityId = $(this).data('row-id');
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
                $.post('activity/' + activityId, {_method: 'DELETE'}, function () {
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