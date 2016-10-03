@extends('layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard/') }}">GMC</a></li>
    <li class="active">Education</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Education <small>Master data of education.</small></h2>
        <a href="{{ action('EducationController@create') }}" class="btn btn-icon pull-right bgm-green" data-toggle="tooltip" data-placement="left" title="Create New Education">
            <i class="add-new-item zmdi zmdi-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table id="bootgrid" class="table table-hover table-condensed table-vmiddle" data-url="{{ route('education.bootgrid') }}">
            <thead>
                <tr>
                    <th data-column-id="educationName" data-type="string" data-identifier="true">Name</th>
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
            commands: function (column, row) {
                return '<a href="{{ url("education") }}/' + row.educationId + '/edit" class="btn btn-icon bgm-blue command-edit" title="Edit ' + row.educationName + '"><span class="zmdi zmdi-edit"></span></a>&nbsp; ' +
                        '<button type="button" class="btn btn-icon bgm-red command-delete" data-row-id="' + row.educationId + '" title="Delete ' + row.educationName + '"><span class="zmdi zmdi-delete"></span></button>';
            }
        }
    }).on('loaded.rs.jquery.bootgrid', function () {
        $('#bootgrid').find('.command-delete').on('click', function (e) {
            e.preventDefault();
            deletes('education', $(this).data('row-id'));
        });
    });
})(jQuery);
</script>
@stop