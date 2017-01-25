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
                layer: $('input[name="layerId"]').val()
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
            iD: function (column, row) {
                return $.strPad(row.questionId, 3, '#');
            },
            text: function (column, row) {
                return (row.questionText) ? row.questionText : row.questionAnswer;
            },
            master: function (column, row) {
                return (row.master) ? row.master.masterName : '';
            },
            commands: function (column, row) {
                var btnEdit = '<a href="#" data-href="' + baseUrl + '/audiences/question/' + row.questionId + '/edit" class="btn btn-icon bgm-blue command-edit" data-toggle="tooltip" title="Edit"><span class="zmdi zmdi-edit"></span></a>&nbsp;';
                var btnDelete = '<button type="button" class="btn btn-icon bgm-red command-delete" data-row-id="' + row.questionId + '" data-toggle="tooltip" title="Delete"><span class="zmdi zmdi-delete"></span></button>';
                return btnEdit + btnDelete;
            }
        }
    }).on('loaded.rs.jquery.bootgrid', function () {
        $('input[type="checkbox"]').prop('checked', false);
        $('#bootgrid').find('.command-edit').on('click', function (e) {
            e.preventDefault();
            $.get($(this).data('href'), function (data) {
                $(data).modal().on('shown.bs.modal', function () {
                    var $t = $(this);
                    var questionType = $t.find('input[name="questionType"]').val();
                    $t.find('[autofocus]').focus();
                    if (questionType == 'useMaster') {
                        $t.find('.questionText, .questionAnswer, .questionFormType').addClass('hide');
                    } else if (questionType == 'essay') {
                        $t.find('.master, .questionAnswer').addClass('hide');
                    } else if (questionType == 'multipleChoice' || questionType == 'trueOrFalse') {
                        $t.find('.master, .questionFormType').addClass('hide');
                    }

                }).on('hidden.bs.modal', function () {
                    clearField({create: false});
                });
            });
        });

        $('#bootgrid').find('.command-delete').on('click', function (e) {
            e.preventDefault();
            $(this).ajaxDelete({
                url: 'audiences/question/'
            });
        });
    });

    $('a.create').click(function (e) {
        e.preventDefault();
        $('div#create').modal('show');
    });

    var divModal = $('body').find('div.modal');

    var clearField = function (response) {
        if (response._method !== 'PATCH') {
            divModal.find(':input').not('input[name="layerId"]').val(null).blur();
            divModal.find('.master, .questionText, .questionAnswer, .questionFormType').addClass('hide');
        } else {
            $.each(response, function (k, v) {
                if (k < response.length) {
                    divModal.find('.' + k).addClass('hide');
                }
            });
        }

        $('input[type="checkbox"]').prop('checked', false);
        divModal.find('div.form-group').removeClass('has-warning');
        divModal.find('small.help-block').text(null);
        $('body').find('#bootgrid').bootgrid('reload');
    };

    divModal.find('.master, .questionText, .questionAnswer, .questionFormType').addClass('hide');
    divModal.on('change', 'select[name="questionType"]', function () {
        var questionType = $(this).find("option:selected").val();
        if (questionType == 'essay') {
            divModal.find('.master, .questionAnswer').addClass('hide');
            divModal.find('input[name="questionAnswer"], select[name="masterId"], select[name="questionFormType"]').val(null).blur();
            divModal.find('.questionText, .questionFormType').removeClass('hide');
        } else if (questionType == 'multipleChoice' || questionType == 'trueOrFalse') {
            divModal.find('.master, .questionFormType').addClass('hide');
            divModal.find('input[name="questionAnswer"], input[name="questionText"], select[name="masterId"], select[name="questionFormType"], input[name="questionDesc"]').val(null).blur();
            divModal.find('.questionText, .questionAnswer').removeClass('hide');
        } else if (questionType == 'useMaster') {
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
                    title: null,
                    html: true,
                    text: '<strong class="f-20">Success</strong><br />Data Saved.',
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