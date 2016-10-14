@extends('layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard/', 'GMC') }}</li>
    <li class="active">Cities</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Cities <small>Master data of city.</small></h2>
<!--        <a href="{{ action('Residence\City@create') }}" class="btn btn-icon pull-right bgm-green" data-toggle="tooltip" data-placement="left" title="Create New Cities">
            <i class="add-new-item zmdi zmdi-plus"></i>
        </a>-->
    </div>

    <div class="table-responsive">
        <table id="bootgrid" class="table table-hover table-condensed table-vmiddle" data-url="{{ $bootgrid }}">
            <thead>
                <tr>
                    <th data-column-id="cityName" data-type="string" data-sortable="true" data-identifier="true">Name</th>
                    <th data-column-id="province" data-type="string" data-formatter="province" data-sortable="true">Province</th>
                    <th data-column-id="greaterArea" data-type="string" data-sortable="true">Greater Area</th>
                    <th data-column-id="cityCode" data-type="string" data-sortable="true">Code</th>
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
                province: function (column, row) {
                    return (row.province) ? row.province.provinceName : null;
                }
            }
        });
    })(jQuery);
</script>
@endpush