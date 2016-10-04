@extends('layouts.materialAdmin')

@section('breadcrumb')
<ol class="breadcrumb">
    <li>{{ link_to('dashboard', 'GMC') }}</li>
    <li>{{ link_to('layerQuestion', 'Layer Questions') }}</li>
    <li class="active">Questions</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h2>{{ $layer->layerName }} Layer Question<small>Master data of {{ strtolower($layer->layerName) }} layer question.</small></h2>
        <a class="btn bgm-green pull-right btn-icon create" data-toggle="tooltip" data-placement="top" title="Create New Layer Questions">
            <i class="zmdi zmdi-plus"></i>
        </a>
        <a href="{{ action('LayerController@index') }}" class="btn bgm-orange pull-right m-r-10 btn-icon" data-toggle="tooltip" data-placement="left" title="Back">
            <i class="zmdi zmdi-arrow-left"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table id="bootgrid" class="table table-striped table-condensed table-vmiddle" data-url="{{ route('question.bootgrid') }}">
            <thead>
                <tr>
                    <th data-column-id="questionId" data-type="numeric" data-formatter="iD" data-identifier="true">#Id</th>
                    <th data-column-id="questionType" data-type="string">Type</th>
                    <th data-column-id="masterId" data-formatter="master" data-type="string">Use Master</th>
                    <th data-column-id="questionText" data-formatter="text" data-type="string">Text/Answer</th>
                    <th data-column-id="questionDesc" data-type="string">Description</th>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@include('audiences.layerQuestion.question.create')

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
        post: function () {
            return {
                layer: '{{{ $layer->layerId }}}'
            };
        },
        css: {
            icon: 'zmdi icon',
            iconColumns: 'zmdi-view-module',
            iconDown: 'zmdi-sort-desc',
            iconUp: 'zmdi-sort-asc',
            iconRefresh: 'zmdi-refresh'
        },
        formatters: {
            iD: function(column, row) {
                return $.strPad(row.questionId, 3, '#');
            },
            text: function (column, row) {
                return (row.questionText) ? row.questionText : row.questionAnswer;
            },
            master: function (column, row) {
                return (row.master) ? row.master.masterName : '';
            },
            commands: function (column, row) {
                return '<a href="#" data-href="{{ url("question") }}/' + row.questionId + '/edit" class="btn btn-icon bgm-blue command-edit" data-toggle="tooltip" title="Edit"><span class="zmdi zmdi-edit"></span></a>&nbsp;' +
                        '<button type="button" class="btn btn-icon bgm-red command-delete" data-row-id="' + row.questionId + '" data-toggle="tooltip" title="Delete"><span class="zmdi zmdi-delete"></span></button>';
            }
        }
    }).on('loaded.rs.jquery.bootgrid', function () {

        $('#bootgrid').find('.command-edit').on('click', function (e) {
            e.preventDefault();
            $.get($(this).data('href'), function (data) {
                $(data).modal().on('shown.bs.modal', function () {
                    $(this).find('[autofocus]').focus();
                });
            });
        });

        $('#bootgrid').find('.command-delete').on('click', function (e) {
            e.preventDefault();
            deletes('question', $(this).data('row-id'));
        });
    });

    $('a.create').click(function (e) {
        e.preventDefault();
        $('div#create').modal('show');
    });

    var divModal = $('body').find('div.modal');

    var clearField = function (response) {
        if (response._method !== 'PATCH') {
            divModal.find(':input').val(null).blur();
            divModal.find('.master, .questionText, .questionAnswer, .questionFormType').addClass('hide');
        } else {
            $.each(response, function (k, v) {
                if (k < response.length)
                    divModal.find('.' + k).addClass('hide');
            });
        }

        divModal.find('div.form-group').removeClass('has-warning');
        divModal.find('small.help-block').text(null);
        $('body').find('#bootgrid').bootgrid('reload');
    };

    divModal.on('change', 'select[name="questionType"]', function () {
        var questionType = $(this).find("option:selected").val();
        if (questionType === 'essay') {
            divModal.find('.master, .questionAnswer').addClass('hide');
            divModal.find('input[name="questionAnswer"], select[name="masterId"]').val(null).blur();
            divModal.find('.questionText, .questionFormType').removeClass('hide');
        } else if (questionType === 'multipleChoice' || questionType === 'trueOrFalse') {
            divModal.find('.master').addClass('hide');
            divModal.find('input[name="questionAnswer"], input[name="questionText"], select[name="masterId"], select[name="questionFormType"], input[name="questionDesc"]').val(null).blur();
            divModal.find('.questionText, .questionAnswer, .questionFormType').removeClass('hide');
        } else if (questionType === 'useMaster') {
            divModal.find('.questionText, .questionAnswer, .questionFormType').addClass('hide');
            divModal.find('input[name="questionAnswer"], input[name="questionText"], select[name="questionFormType"], input[name="questionDesc"]').val(null).blur();
            divModal.find('.master').removeClass('hide');
        }
    });
    
    divModal.on('change', 'select[name="masterId"]', function () {
        divModal.find('input[name="questionText"]').val($(this).find("option:selected").text());
    });

    $('body').on('submit', 'form.layerQuestion', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (data) {
                swal({
                    title: 'Success!',
                    text: 'Data Saved.',
                    type: 'success',
                    showConfirmButton: false,
                    timer: 2000
                });
                clearField(data);
            },
            error: function (response) {
                divModal.find('div.form-group').removeClass('has-warning');
                $.each($.parseJSON(response.responseText), function (k, v) {
                    divModal.find('#' + k).parents('div.form-group').addClass('has-warning');
                    divModal.find('#' + k).text(v);
                });
            }
        });
    });

    $('div#create').on('hidden.bs.modal', function () {
        clearField({create: false});
    });
    
})(jQuery);
</script>
@stop