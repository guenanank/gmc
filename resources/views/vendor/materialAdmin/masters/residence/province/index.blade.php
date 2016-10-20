@extends('vendor.layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard/', 'GMC') }}</li>
    <li class="active">Provinces</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Provinces <small>Master data of province.</small></h2>
        <!--        <a href="{{ '#' }}" class="btn btn-icon pull-right bgm-green" data-toggle="tooltip" data-placement="left" title="Create New Province">
                    <i class="add-new-item zmdi zmdi-plus"></i>
                </a>-->
    </div>
    <div class="table-responsive">
        <table id="bootgrid" class="table table-hover table-condensed table-vmiddle" data-url="{{ $bootgrid }}">
            <thead>
                <tr>
                    <th data-column-id="provinceName" data-type="string" data-sortable="true" data-identifier="true">Name</th>
                    <th data-column-id="provinceCode" data-type="string" data-sortable="true">Code</th>
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
            rowCount: [10, 25, 50, -1],
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

                }
            }
        });
    })(jQuery);
</script>
@endpush