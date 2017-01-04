/**
 * jQuery Nested Region Data
 * 
 * Used for nested dropdown select region data base on api target
 *
 * @author nanank
 */

(function ($) {

    $.fn.regions = function (obj) {

        var setting = $.fn.extend({
            api: 'https://api.gramedia-majalah.com/v1/region/',
            token: $('meta[name="api-token"]').attr('content'),
            target: {},
            callback: function () { }
        }, obj);

        return this.each(function () {

            $(this).on('changed.bs.select', function (e) {
                var $t = $(this);

                $.ajaxSetup({
                    url: setting.api + setting.target.name + '/' + $t.attr('id') + '/' + $t.val() + '?token=' + setting.token,
                    dataType: 'json',
                    method: 'GET',
                    beforeSend: function () {
                        $('#' + setting.target.name + ' option').remove();
                    },
                    success: function (data) {
                        $.each(data, function (k, v) {
                            $('#' + setting.target.name)
                                    .append('<option value="'
                                            + v[setting.target.index] + '">'
                                            + v[setting.target.value] + '</option>');
                        });

                        $('#' + setting.target.name).selectpicker('refresh');
                    }
                });

                $.ajax();
                setting.callback();
            });

        });
    };

    $('select#province').regions({
        target: {name: 'regency', index: 'regencyId', value: 'regencyName'},
        callback: function () {
            $('select#regency').regions({
                target: {name: 'district', index: 'districtId', value: 'districtName'},
                callback: function () {
                    $('select#district').regions({
                        target: {name: 'village', index: 'villageId', value: 'villageName'}
                    });
                }
            });
        }
    });

})(jQuery);