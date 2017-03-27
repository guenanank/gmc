/**
 * jQuery AJAX form
 * used only for material admin template
 *
 * @author nanank
 */

(function ($) {

    $.fn.ajaxForm = function (obj) {

        var setting = $.fn.extend({
            url: '',
            data: {}
        }, obj);

        return this.each(function () {
            var $t = $(this);

            var $clear = function (create) {
                if (create) {
                    $t.find(':input').val(null).trigger('blur');
                    $('.selectpicker').selectpicker('refresh');
                }
                $('div.form-group').removeClass('has-warning');
                $('small.help-block').text(null);
            };

            $.ajax({
                type: $t.attr('method'),
                url: (setting.url) ? setting.url : $t.attr('action'),
                data: (typeof setting.data === 'undefined') ? setting.data : $t.serialize(),
                beforeSend: function () {
                    $clear(false);
                },
                statusCode: {
                    200: function (data) {
                        swal({
                            title: null,
                            html: true,
                            text: '<strong class="f-20">Success</strong><br />Data Saved.',
                            showConfirmButton: false,
                            timer: 2000,
                            type: 'success'
                        });
                        $clear(data.create);
                        $('[class^=form-wizard]').bootstrapWizard('first');
                    },
                    422: function (response) {
                        $.each(response.responseJSON, function (k, v) {
                            $('#' + k).parents('div.form-group').addClass('has-warning');
                            $('#' + k).text(v);
                        });
                    }
                }
            });
        });
    };

    $.fn.ajaxDelete = function (obj) {
        var setting = $.fn.extend({
            url: ''
        }, obj);

        return this.each(function () {
            $.ajaxSetup({
                type: 'POST',
                url: setting.url + $(this).data('row-id'),
                data: {_method: 'DELETE'},
                statusCode: {
                    200: function () {
                        swal({
                            html: true,
                            title: null,
                            text: '<strong class="f-20">Deleted</strong><br />Your file has been deleted.',
                            type: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                }
            });

            swal({
                html: true,
                title: null,
                text: '<strong class="f-20">Are you sure?</strong><br />You will not be able to recover this file!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, delete it!',
                closeOnConfirm: false,
                closeOnCancel: false
            }, function (confirm) {
                if (confirm) {
                    $.ajax().done(function() {
                        $('#bootgrid').bootgrid('reload');
                    });
                } else {
                    swal({
                        html: true,
                        title: null,
                        text: '<strong class="f-20">Cancelled</strong><br />Your file is safe :)',
                        type: 'error',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        });
    };

})(jQuery);