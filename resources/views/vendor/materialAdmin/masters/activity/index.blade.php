@extends('vendor.materialAdmin.layouts.materialAdmin')

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
        <a href="{{ action('Masters\Activity@create') }}" class="btn btn-icon pull-right bgm-green" data-toggle="tooltip" data-placement="left" title="Create New Activities">
            <i class="add-new-item zmdi zmdi-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table id="bootgrid" class="table table-hover table-condensed table-vmiddle" data-url="{{ route('activity.bootgrid') }}">
            <thead>
                <tr>
                    <th data-column-id="activityName" data-formatter="activityName" data-type="string">Name</th>
                    <th data-column-id="activityWhere" data-type="string">Location</th>
                    <th data-column-id="activityWhen" data-converter="datetime" data-type="date">Date</th>
                    <th data-column-id="sourceId" data-formatter="source" data-type="string">Source</th>
                    <th data-column-id="mediaGroupId" data-formatter="mediaGroup" data-type="string" data-sortable="false">Media Group</th>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('scripts')
{{ Html::script('js/clipboard.min.js') }}
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
                activityName: function (column, row) {
                    var activityName = row.activityName.length > 37 ? row.activityName.substring(0, 37) + '...' : row.activityName;
                    return '<span data-toggle="tooltip" data-placement="right" title="' + row.activityName + '">' + activityName + '</span>';
                },
                source: function (column, row) {
                    return (row.source) ? row.source.sourceName : 'None';
                },
                mediaGroup: function (column, row) {
                    $.get(apiTarget + 'gateway/mediaGroup/' + row.mediaGroupId + '?token=' + apiToken, function (mediaGroup) {
                        $('span.media-group').text(mediaGroup.mediaGroupName);
                    });
                    return '<span class="media-group"></span>';
                },
                commands: function (column, row) {
                    var btnCopy = '<button id="btn" type="button" class="btn btn-icon bgm-bluegray command-copy" data-toggle="tooltip" title="Copy token into clipboard\n' + row.activityToken + '" data-clipboard-text="' + row.activityToken + '"><span class="zmdi zmdi-copy"></span></button>&nbsp; ';
                    var btnEdit = '<a href="{{ url("masters/activity") }}/' + row.activityId + '/edit" class="btn btn-icon bgm-blue command-edit" data-toggle="tooltip" title="Edit ' + row.activityName + '"><span class="zmdi zmdi-edit"></span></a>&nbsp; ';
                    var btnDelete = '<button type="button" class="btn btn-icon bgm-red command-delete" data-row-id="' + row.activityId + '" data-toggle="tooltip" title="Delete ' + row.activityName + '"><span class="zmdi zmdi-delete"></span></button>';
                    return btnCopy + btnEdit + btnDelete;
                }
            }
        }).on('loaded.rs.jquery.bootgrid', function () {

            $('[data-toggle="tooltip"]').tooltip();

            $('#bootgrid').find('.command-copy').on('click', function () {
                var clipboard = new Clipboard(this);
                console.log(clipboard);
                clipboard.on('success', function () {
                    swal({
                        title: null,
                        html: true,
                        text: '<strong class="f-20">Copied</strong><br />Activity token was copied into cliboard.',
                        type: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                });
            });

            $('#bootgrid').find('.command-delete').on('click', function (e) {
                e.preventDefault();
                $(this).ajaxDelete({
                    url: 'activity/' + $(this).data('row-id')
                });
            });
        });
    })(jQuery);
</script>
@endpush