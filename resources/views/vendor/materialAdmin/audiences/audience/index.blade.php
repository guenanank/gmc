@extends('vendor.materialAdmin.layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard', 'GMC') }}</li>
    <li class="active">Audiences</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Audiences <small>Master data of audience.</small></h2>
        <a href="{{ action('Audiences\Audience@create') }}" class="btn btn-icon pull-right bgm-green" data-toggle="tooltip" data-placement="left" title="Create New Audiences">
            <i class="add-new-item zmdi zmdi-plus"></i>
        </a>

        <a href="{{ action('Upload@index') }}" class="btn bgm-teal btn-icon pull-right m-r-10" data-toggle="tooltip" data-placement="top" title="Upload Audiences">
            <i class="zmdi zmdi-upload"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table id="bootgrid" class="table table-hover table-condensed table-vmiddle" data-url="{{ route('audience.bootgrid') }}">
            <thead>
                <tr>
                    <th data-column-id="audienceId" data-formatter="pk" data-type="int" data-identifier="true">Audience ID</th>
                    <th data-column-id="audienceType" data-formatter="type" data-type="string">Audience Type</th>
                    <th data-column-id="clubId" data-type="string">Club ID</th>
                    <th data-column-id="memberId" data-type="string">Member ID</th>
                    <th data-column-id="activityId" data-formatter="activity" data-type="string">Activity</th>
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
                iconDown: 'zmdi-caret-down',
                iconUp: 'zmdi-caret-up',
                iconRefresh: 'zmdi-refresh'
            },
            formatters: {
                pk: function (column, row) {
                    return $.strPad(row.audienceId, 8);
                },
                type: function (column, row) {
                    return row.audienceType.substr(0, 1).toUpperCase() + row.audienceType.substr(1);
                },
                activity: function (column, row) {
                    var activities = [];
                    $.each(row.activities, function (k, v) {
                        activities.push(v.activityName);
                    });

                    return activities.join(', ');
                },
                commands: function (column, row) {
                    var detail = '<a data-href="{{ url("audiences/audience/") }}/' + row.audienceId + '" class="bgm-orange command-detail btn btn-default btn-icon waves-effect waves-circle"><i class="zmdi zmdi-search-in-file"></i></a>&nbsp; ';
                    var edit = '<a href="{{ url("audiences/audience") }}/' + row.audienceId + '/edit" class="bgm-blue command-edit btn btn-default btn-icon waves-effect waves-circle" title="Edit"><i class="zmdi zmdi-edit"></i></a>&nbsp; ';
                    var del = '<button type="button" class="bgm-red command-delete btn btn-default btn-icon waves-effect waves-circle" data-row-id="' + row.audienceId + '" title="Delete"><i class="zmdi zmdi-delete"></i></button>';
                    return detail + edit + del;
                }
            }
        }).on('loaded.rs.jquery.bootgrid', function () {
            $('#bootgrid').find('.command-detail').on('click', function (e) {
                e.preventDefault();
                $.get($(this).data('href'), function (data) {
                    $(data).modal();
                });

            });
            $('#bootgrid').find('.command-delete').on('click', function (e) {
                e.preventDefault();
                $(this).ajaxDelete({
                    //url: 'audiences/layerQuestion/'
                });
            });
        });
    })(jQuery);
</script>
@endpush