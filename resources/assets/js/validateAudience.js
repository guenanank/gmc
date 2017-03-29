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
        
        var set = $.fn.extend({
            target: '',
            data: {},
            callback: function() {}
        }, obj);
        
        
        var flag = true;
        this.each(function() {
            
            var $t = $(this);
            var clear = function(stat) {
                if (stat) {
                    $t.find(':input').trigger('blur');
                }

                $('div.form-group').removeClass('has-warning');
                $('small.help-block').text(null);
            };
            
            if ($.isEmptyObject(set.data)) {
                $.each($t.find(':input'), function (k, v) {
                    if (v.name.length)
                        set.data[v.name] = v.value;
                });
            }
                        
            $.ajaxSetup({
                method: 'POST',
                url: set.target,
                async: false,
                data: set.data,
                beforeSend: function() {
                    clear(false);
                },
                statusCode: {
                    200: function(data) {
                        clear(true);
                    },
                    422: function(response) {
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
            
            $.ajax().done(function(data, msg, jqXHR) {
                set.callback.call(jqXHR);
            }).fail(function(jqXHR){
                set.callback.call(jqXHR);
                flag = false;
            });
            
        });
        
        return flag;
        
    };
})(jQuery);