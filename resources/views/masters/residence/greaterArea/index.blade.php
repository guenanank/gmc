@extends('layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard/', 'GMC') }}</li>
    <li class="active">Greater Areas</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Greater Areas <small>Master data of greater area.</small></h2>
        <!--        <a href="{{ action('Residence\GreaterArea@create') }}" class="btn btn-icon pull-right bgm-green" data-toggle="tooltip" data-placement="left" title="Create New Greater Areas">
                    <i class="add-new-item zmdi zmdi-plus"></i>
                </a>-->
    </div>

    <div class="table-responsive">
        <table id="bootgrid" class="table table-hover table-condensed table-vmiddle" data-url="{{ $bootgrid }}">
            <thead>
                <tr>
                    <th data-column-id="greaterAreaName" data-type="string" data-sortable="true" data-identifier="true">Name</th>
                    <th data-column-id="city" data-type="string" data-sortable="false" data-formatter="cities">Cities</th>
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
                cities: function (column, row) {
                    var cities = [];
                    $.each(row.cities, function (k, v) {
                        cities.push(v.cityName);
                    });

                    return cities.join(', ');
                },
                commands: function (column, row) {

                }
            }
        });
    })(jQuery);
</script>
@endpush