/**
 * jQuery AJAX form
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
                    $('.selectpicker').selectpicker('deselectAll');
                }
                $('div.form-group').removeClass('has-warning');
                $('small.help-block').text(null);
            };

            var ajaxSetup = {
                type: $t.attr('method'),
                url: (setting.url) ? setting.url : $t.attr('action'),
                data: (typeof setting.data === 'undefined') ? setting.data : $t.serialize(),
                beforeSend: function () {
                    $clear(false);
                },
                statusCode: {
                    200: function (data) {
                        swal({
                            title: 'Success!',
                            text: 'Data Saved.',
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
            };

            $.ajax(ajaxSetup);
        });
    };
})(jQuery);