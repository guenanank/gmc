@extends('vendor.materialAdmin.layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard', 'GMC') }}</li>
    <li class="active">Classification</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Classification <small>Master data of vehicle classification.</small></h2>
        <a href="{{ action('Vehicles\Classification@create') }}" class="btn btn-icon pull-right bgm-green" data-toggle="tooltip" data-placement="left" title="Create New Classification">
            <i class="add-new-item zmdi zmdi-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table id="bootgrid" class="table table-hover table-condensed table-vmiddle" data-url="{{ $target . '/bootgrid?token=' . Request::session()->get('api_token') }}">
            <thead>
                <tr>
                    <th data-column-id="classificationName" data-type="string" data-identifier="true">Name</th>
                    <th data-column-id="classificationDesc" data-type="string">Description</th>
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
                commands: function (column, row) {
                    var edit = '<a href="{{ url("vehicles/classification") }}/' + row.classificationId + '/edit" class="bgm-blue command-edit btn btn-default btn-icon waves-effect waves-circle" title="Edit ' + row.classificationName + '"><i class="zmdi zmdi-edit"></i></a>&nbsp; ';
                    var del = '<button type="button" class="btn btn-icon bgm-red command-delete" data-row-id="' + row.classificationId + '" title="Delete ' + row.classificationName + '"><i class="zmdi zmdi-delete"></i></button>';
                    return edit + del;
                }
            }
        }).on('loaded.rs.jquery.bootgrid', function () {
            $('#bootgrid').find('.command-delete').on('click', function (e) {
                e.preventDefault();
                $(this).ajaxDelete({
                    url: apiTarget + 'vehicle/classification/' + $(this).data('row-id') + '?token=' + apiToken
                });
            });
        });
    })(jQuery);
</script>
@endpush