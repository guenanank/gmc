@extends('vendor.materialAdmin.layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard', 'GMC') }}</li>
    <li class="active">Media Groups</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Media Group <small>Master data of mediaGroups.</small></h2>
        <a href="{{ action('MediaGroup@create') }}" class="btn btn-icon pull-right bgm-green" data-toggle="tooltip" data-placement="left" title="Create New Media Group">
            <i class="add-new-item zmdi zmdi-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table id="bootgrid" class="table table-hover table-condensed table-vmiddle" data-url="{{ route('mediaGroup.bootgrid') }}">
            <thead>
                <tr>
                    <th data-column-id="mediaGroupName" data-type="string" data-identifier="true">Name</th>
                    <th data-column-id="mediaGroupSubFrom" data-formatter="mediaGroupSubFrom" data-type="string">Is Sub From</th>
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
                mediaGroupSubFrom: function (column, row) {
                    if (row.parent)
                        return row.parent.mediaGroupName;
                },
                commands: function (column, row) {
                    var btnEdit = '<a href="{{ url("mediaGroup") }}/' + row.mediaGroupId + '/edit" class="btn btn-icon bgm-blue command-edit" title="Edit ' + row.mediaGroupName + '"><span class="zmdi zmdi-edit"></span></a>&nbsp; ';
                    var btnDelete = '<button type="button" class="btn btn-icon bgm-red command-delete" data-row-id="' + row.mediaGroupId + '" title="Delete ' + row.mediaGroupName + '"><span class="zmdi zmdi-delete"></span></button>';
                    return btnEdit + btnDelete;
                }
            }
        }).on('loaded.rs.jquery.bootgrid', function () {
            $('#bootgrid').find('.command-delete').on('click', function (e) {
                e.preventDefault();
                deletes('mediaGroup', $(this).data('row-id'));
            });
        });
    })(jQuery);
</script>
@endpush