@extends('vendor.materialAdmin.layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard/', 'GMC') }}</li>
    <li class="active">Media</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Medias <small>Master data of media.</small></h2>
        <!--a href="{{ $target . '/create?token=' . Request::session()->get('api_token') }}" class="btn btn-icon pull-right bgm-green" data-toggle="tooltip" data-placement="left" title="Create New Media">
            <i class="add-new-item zmdi zmdi-plus"></i>
        </a-->
    </div>

    <div class="table-responsive">
        <table id="bootgrid" class="table table-hover table-condensed table-vmiddle" data-url="{{ $target . '/bootgrid?token=' . Request::session()->get('api_token') }}">
            <thead>
                <tr>
                    <th data-column-id="mediaName" data-type="string" data-sortable="true" data-identifier="true">Name</th>
                    <th data-column-id="mediaTypeId" data-type="string" data-sortable="true" data-formatter="mediaType">Media Type</th>
                    <th data-column-id="mediaGroupId" data-type="string" data-sortable="true" data-formatter="mediaGroup">Media Group</th>
                    <th data-column-id="mediaIsExternal" data-type="string" data-sortable="true">Is External</th>
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
                mediaType: function (column, row) {
                    return (row.media.mediaType) ? row.media.mediaType.mediaTypeName : null;
                },
                mediaGroup: function (column, row) {
                    return (row.media.mediaGroup) ? row.media.mediaGroup.mediaGroupName : null;
                },
                commands: function (column, row) {
                    var edit = '<a href="#" class="bgm-blue command-edit btn btn-default btn-icon waves-effect waves-circle" title="Edit ' + row.mediaName + '"><i class="zmdi zmdi-edit"></i></a>&nbsp; ';
                    var del = '<button type="button" class="bgm-red command-delete btn btn-default btn-icon waves-effect waves-circle" data-row-id="' + row.greaterAreaId + '" title="Delete ' + row.mediaName + '"><i class="zmdi zmdi-delete"></i></button>';
                    return edit + del;
                }
            }
        });
    })(jQuery);
</script>
@endpush