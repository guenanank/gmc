@extends('layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard', 'GMC') }}</li>
    <li class="active">Professions</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Professions <small>Master data of professions.</small></h2>
        <a href="{{ action('Profession@create') }}" class="btn btn-icon pull-right bgm-green" data-toggle="tooltip" data-placement="left" title="Create New Profession">
            <i class="add-new-item zmdi zmdi-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table id="bootgrid" class="table table-hover table-condensed table-vmiddle" data-url="{{ route('profession.bootgrid') }}">
            <thead>
                <tr>
                    <th data-column-id="professionName" data-type="string" data-identifier="true">Name</th>
                    <th data-column-id="professionSubFrom" data-formatter="professionSubFrom" data-type="string">Is Sub From</th>
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
                professionSubFrom: function (column, row) {
                    if (row.parent)
                        return row.parent.professionName;
                },
                commands: function (column, row) {
                    var btnEdit = '<a href="{{ url("profession") }}/' + row.professionId + '/edit" class="btn btn-icon bgm-blue command-edit" title="Edit ' + row.professionName + '"><span class="zmdi zmdi-edit"></span></a>&nbsp; ';
                    var btnDelete = '<button type="button" class="btn btn-icon bgm-red command-delete" data-row-id="' + row.professionId + '" title="Delete ' + row.professionName + '"><span class="zmdi zmdi-delete"></span></button>';
                    return btnEdit + btnDelete;
                }
            }
        }).on('loaded.rs.jquery.bootgrid', function () {
            $('#bootgrid').find('.command-delete').on('click', function (e) {
                e.preventDefault();
                deletes('profession', $(this).data('row-id'));
            });
        });
    })(jQuery);
</script>
@endpush