@extends('vendor.layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard/', 'GMC') }}</li>
    <li class="active">Vehicles</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Vehicles <small>Master data of vehicle.</small></h2>
<!--        <a href="{{ '#' }}" class="btn btn-icon pull-right bgm-green" data-toggle="tooltip" data-placement="left" title="Create New Type">
            <i class="add-new-item zmdi zmdi-plus"></i>
        </a>-->
    </div>

    <div class="table-responsive">
        <table id="bootgrid" class="table table-hover table-condensed table-vmiddle" data-url="{{ $bootgrid }}">
            <thead>
                <tr>
                    <th data-column-id="typeName" data-type="string" data-sortable="true" data-identifier="true">Name</th>
                    <th data-column-id="brandId" data-type="string" data-sortable="true" data-formatter="brand">Brand</th>
                    <th data-column-id="seriesId" data-type="string" data-sortable="true" data-formatter="series">Series</th>
                    <th data-column-id="classificationId" data-type="string" data-sortable="true" data-formatter="classification">Classification</th>
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
                brand: function(column, row) {
                    return (row.series.brand) ? row.series.brand.brandName : null;
                },
                classification: function(column, row) {
                    return (row.series.classification) ? row.series.classification.classificationName : null;
                },
                series: function(column, row) {
                    return (row.series) ? row.series.seriesName : null;
                },
                commands: function (column, row) {
                
                }
            }
        });
    })(jQuery);
</script>
@endpush