@extends('layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard', 'GMC') }}</li>
    <li class="active">Activities</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Activity <small>Master data of activity.</small></h2>
        <a href="{{ action('ActivityController@create') }}" class="btn btn-icon pull-right bgm-green" data-toggle="tooltip" data-placement="left" title="Create New Activities">
            <i class="add-new-item zmdi zmdi-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table id="bootgrid" class="table table-hover table-condensed table-vmiddle" data-url="{{ route('activity.bootgrid') }}">
            <thead>
                <tr>
                    <th data-column-id="activityName" data-type="string">Name</th>
                    <th data-column-id="activityWhere" data-type="string">Location</th>
                    <th data-column-id="activityWhen" data-converter="datetime" data-type="date">Date</th>
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
                    return (row.source) ? row.source.sourceName : 'None';
                },
                mediaGroup: function (column, row) {
                    return (row.media_group) ? row.media_group.mediaGroupName : 'None';
                },
                commands: function (column, row) {
                    var btnCopy = '<button id="btn" type="button" class="btn btn-icon bgm-bluegray command-copy" data-toggle="tooltip" title="Copy token into clipboard\n' + row.activityToken + '" data-clipboard-text="' + row.activityToken + '"><span class="zmdi zmdi-copy"></span></button>&nbsp; ';
                    var btnEdit = '<a href="{{ url("activity") }}/' + row.activityId + '/edit" class="btn btn-icon bgm-blue command-edit" data-toggle="tooltip" title="Edit ' + row.activityName + '"><span class="zmdi zmdi-edit"></span></a>&nbsp; ';
                    var btnDelete = '<button type="button" class="btn btn-icon bgm-red command-delete" data-row-id="' + row.activityId + '" data-toggle="tooltip" title="Delete ' + row.activityName + '"><span class="zmdi zmdi-delete"></span></button>';
                    return btnCopy + btnEdit + btnDelete;
                }
            }
        }).on('loaded.rs.jquery.bootgrid', function () {
            $('#bootgrid').find('.command-copy').on('click', function () {
                var clipboard = new Clipboard(this);
                clipboard.on('success', function () {
                    swal({
                        title: 'Copied!',
                        text: 'Activity token was copied into cliboard.',
                        type: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                });
            });

            $('#bootgrid').find('.command-delete').on('click', function (e) {
                e.preventDefault();
                deletes('activity', $(this).data('row-id'));
            });
        });
    })(jQuery);
</script>
@stop