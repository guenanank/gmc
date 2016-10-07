@extends('layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard', 'GMC') }}</li>
    <li class="active">Media</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Media <small>Master data of media.</small></h2>
        <a href="{{ action('MediaController@create') }}" class="btn btn-icon pull-right bgm-green" data-toggle="tooltip" data-placement="left" title="Create New Media">
            <i class="add-new-item zmdi zmdi-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table id="bootgrid" class="table table-hover table-condensed table-vmiddle" data-url="{{ route('media.bootgrid') }}">
            <thead>
                <tr>
                    <th data-column-id="mediaName" data-type="string" data-identifier="true">Name</th>
                    <th data-column-id="mediaTypeId" data-formatter="mediaType" data-type="string">Type</th>
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
                mediaType: function (column, row) {
                    return (row.media_type) ? row.media_type.mediaTypeName : 'Unknown';
                },
                commands: function (column, row) {
                    var btnEdit = '<a href="{{ url("media") }}/' + row.mediaId + '/edit" class="btn btn-icon bgm-blue command-edit" title="Edit ' + row.mediaName + '"><span class="zmdi zmdi-edit"></span></a>&nbsp; ';
                    var btnDelete = '<button type="button" class="btn btn-icon bgm-red command-delete" data-row-id="' + row.mediaId + '" title="Delete ' + row.mediaName + '"><span class="zmdi zmdi-delete"></span></button>';
                    return btnEdit + btnDelete;
                }
            }
        }).on('loaded.rs.jquery.bootgrid', function () {
            $('#bootgrid').find('.command-delete').on('click', function (e) {
                e.preventDefault();
                deletes('media', $(this).data('row-id'));
            });
        });
    })(jQuery);
</script>
@stop