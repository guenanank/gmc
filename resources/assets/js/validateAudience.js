/**
 * jQuery Validate Audience
 * 
 * Asynchronus AJAX 
 * Validate all input from audience
 *
 * @author nanank
 */

(function ($) {

    $.fn.validateAudience = function (obj) {
        var setting = $.fn.extend({
            target: 'validate',
            data: {},
            callback: function () {}
        }, obj);

        var $flag = false;

        this.each(function () {
            var $t = $(this);
            if ($.isEmptyObject(setting.data)) {
                $.each($t.find(':input'), function (k, v) {
                    if (v.name.length)
                        setting.data[v.name] = v.value;
                });
            }

            var $clear = function (create) {
                if (create) {
                    $('form').find(':input').trigger('blur');
                    $('.selectpicker').selectpicker('deselectAll');
                }
                $('div.form-group').removeClass('has-warning');
                $('small.help-block').text(null);
            };

            $.ajaxSetup({
                url: setting.target,
                method: 'POST',
                data: setting.data,
                async: false,
                beforeSend: function () {
                    $clear(false);
                },
                statusCode: {
                    200: function (data) {
                        $clear(data.create);
                    },
                    422: function (response) {
                        $.notify({
                            message: 'Oh snap! Change a few things up and try submitting again.'
                        }, {
                            type: 'danger',
                            allow_dismiss: false,
                            label: 'Cancel',
                            className: 'btn-xs btn-inverse',
                            placement: {
                                from: 'top',
                                align: 'right'
                            },
                            delay: 2500,
                            animate: {
                                enter: 'animated bounceIn',
                                exit: 'animated bounceOut'
                            },
                            offset: {
                                x: 20,
                                y: 85
                            }
                        });
                        $.each(response.responseJSON, function (k, v) {
                            $('#' + k).parents('div.form-group').addClass('has-warning');
                            $('#' + k).text(v);
                        });
                    }
                }
            });

            $.ajax().done(function (data, msg, jqXHR) {
                $flag = true;
                setting.callback.call(jqXHR);
            }).fail(function (jqXHR) {
                $flag = false;
                setting.callback.call(jqXHR);
            });

        });

        return $flag;
    };
})(jQuery);