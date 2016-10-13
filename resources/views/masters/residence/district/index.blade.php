@extends('layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard/', 'GMC') }}</li>
    <li class="active">Districts</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Districts <small>Master data of district.</small></h2>
        <a href="{{ action('Residence\DistrictController@create') }}" class="btn btn-icon pull-right bgm-green" data-toggle="tooltip" data-placement="left" title="Create New Education">
            <i class="add-new-item zmdi zmdi-plus"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table id="bootgrid" class="table table-hover table-condensed table-vmiddle" data-url="{{ $bootgrid }}">
            <thead>
                <tr>
                    <th data-column-id="districtName" data-type="string" data-sortable="true" data-identifier="true">Name</th>
                    <th data-column-id="cityId" data-type="string" data-formatter="city" data-sortable="true">City</th>
                    <th data-column-id="districtPostCode" data-type="string" data-sortable="true">Postcode</th>
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
                city: function(column, row) {
                    return (row.city) ? row.city.cityName : null;
                },
                commands: function (column, row) {

                }
            }
        });
    })(jQuery);
</script>
@stop