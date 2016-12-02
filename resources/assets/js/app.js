/*
 * Detact Mobile Browser
 */
if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    $('html').addClass('ismobile');
}

if ($('html').hasClass('ismobile') === false) {
    if ($('.page-loader')[0]) {
        setTimeout(function () {
            $('.page-loader').fadeOut();
        }, 500);
    }
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        _token: $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    (function () {
        var layoutStatus = localStorage.getItem('ma-layout-status');
        if (!$('#header-2')[0]) {
            if (layoutStatus == 1) {
                $('body').addClass('sw-toggled');
                $('#tw-switch').prop('checked', true);
            }
        }

        $('body').on('change', '#toggle-width input:checkbox', function () {
            if ($(this).is(':checked')) {
                setTimeout(function () {
                    $('body').addClass('toggled sw-toggled');
                    localStorage.setItem('ma-layout-status', 1);
                }, 250);
            } else {
                setTimeout(function () {
                    $('body').removeClass('toggled sw-toggled');
                    localStorage.setItem('ma-layout-status', 0);
                }, 250);
            }
        });
    })();

    function scrollBar(selector, theme, mousewheelaxis) {
        $(selector).mCustomScrollbar({
            theme: theme,
            scrollInertia: 100,
            axis: 'yx',
            mouseWheel: {
                enable: true,
                axis: mousewheelaxis,
                preventDefault: true
            }
        });
    }

    if ($('html').hasClass('ismobile') === false) {
        //On Custom Class
        if ($('.c-overflow')[0]) {
            scrollBar('.c-overflow', 'minimal-dark', 'y');
        }
    }

    (function () {
        $('body').on('click', '#top-search > a', function (e) {
            e.preventDefault();

            $('#header').addClass('search-toggled');
            $('#top-search-wrap input').focus();
        });

        $('body').on('click', '#top-search-close', function (e) {
            e.preventDefault();

            $('#header').removeClass('search-toggled');
        });
    })();

    (function () {
        //Toggle
        $('body').on('click', '#menu-trigger, #chat-trigger', function (e) {
            e.preventDefault();
            var x = $(this).data('trigger');

            $(x).toggleClass('toggled');
            $(this).toggleClass('open');

            //Close opened sub-menus
            $('.sub-menu.toggled').not('.active').each(function () {
                $(this).removeClass('toggled');
                $(this).find('ul').hide();
            });



            $('.profile-menu .main-menu').hide();

            if (x == '#sidebar') {

                $elem = '#sidebar';
                $elem2 = '#menu-trigger';

                $('#chat-trigger').removeClass('open');

                if (!$('#chat').hasClass('toggled')) {
                    $('#header').toggleClass('sidebar-toggled');
                } else {
                    $('#chat').removeClass('toggled');
                }
            }

            if (x == '#chat') {
                $elem = '#chat';
                $elem2 = '#chat-trigger';

                $('#menu-trigger').removeClass('open');

                if (!$('#sidebar').hasClass('toggled')) {
                    $('#header').toggleClass('sidebar-toggled');
                } else {
                    $('#sidebar').removeClass('toggled');
                }
            }

            //When clicking outside
            if ($('#header').hasClass('sidebar-toggled')) {
                $(document).on('click', function (e) {
                    if (($(e.target).closest($elem).length === 0) && ($(e.target).closest($elem2).length === 0)) {
                        setTimeout(function () {
                            $($elem).removeClass('toggled');
                            $('#header').removeClass('sidebar-toggled');
                            $($elem2).removeClass('open');
                        });
                    }
                });
            }
        })

        //Submenu
        $('body').on('click', '.sub-menu > a', function (e) {
            e.preventDefault();
            $(this).next().slideToggle(200);
            $(this).parent().toggleClass('toggled');
        });
    })();

    $('body').on('click', '[data-clear="notification"]', function (e) {
        e.preventDefault();

        var x = $(this).closest('.listview');
        var y = x.find('.lv-item');
        var z = y.size();

        $(this).parent().fadeOut();

        x.find('.list-group').prepend('<i class="grid-loading hide-it"></i>');
        x.find('.grid-loading').fadeIn(1500);


        var w = 0;
        y.each(function () {
            var z = $(this);
            setTimeout(function () {
                z.addClass('animated fadeOutRightBig').delay(1000).queue(function () {
                    z.remove();
                });
            }, w += 150);
        })

        //Popup empty message
        setTimeout(function () {
            $('#notifications').addClass('empty');
        }, (z * 150) + 200);
    });

    if ($('.dropdown')[0]) {
        //Propagate
        $('body').on('click', '.dropdown.open .dropdown-menu', function (e) {
            e.stopPropagation();
        });

        $('.dropdown').on('shown.bs.dropdown', function (e) {
            if ($(this).attr('data-animation')) {
                $animArray = [];
                $animation = $(this).data('animation');
                $animArray = $animation.split(',');
                $animationIn = 'animated ' + $animArray[0];
                $animationOut = 'animated ' + $animArray[1];
                $animationDuration = ''
                if (!$animArray[2]) {
                    $animationDuration = 500; //if duration is not defined, default is set to 500ms
                } else {
                    $animationDuration = $animArray[2];
                }

                $(this).find('.dropdown-menu').removeClass($animationOut)
                $(this).find('.dropdown-menu').addClass($animationIn);
            }
        });

        $('.dropdown').on('hide.bs.dropdown', function (e) {
            if ($(this).attr('data-animation')) {
                e.preventDefault();
                $this = $(this);
                $dropdownMenu = $this.find('.dropdown-menu');

                $dropdownMenu.addClass($animationOut);
                setTimeout(function () {
                    $this.removeClass('open')

                }, $animationDuration);
            }
        });
    }

    if ($('.auto-size')[0]) {
        autosize($('.auto-size'));
    }

    $('body').on('click', '.profile-menu > a', function (e) {
        e.preventDefault();
        $(this).parent().toggleClass('toggled');
        $(this).next().slideToggle(200);
    });

    if ($('.fg-line')[0]) {
        $('body').on('focus', '.fg-line .form-control', function () {
            $(this).closest('.fg-line').addClass('fg-toggled');
        });

        $('body').on('blur', '.form-control', function () {
            var p = $(this).closest('.form-group, .input-group');
            var i = p.find('.form-control').val();

            if (p.hasClass('fg-float')) {
                if (i.length == 0) {
                    $(this).closest('.fg-line').removeClass('fg-toggled');
                }
            } else {
                $(this).closest('.fg-line').removeClass('fg-toggled');
            }
        });
    }

    if ($('.fg-float')[0]) {
        $('.fg-float .form-control').each(function () {
            var i = $(this).val();

            if (!i.length == 0) {
                $(this).closest('.fg-line').addClass('fg-toggled');
            }

        });
    }

    if ($('input-mask')[0]) {
        $('.input-mask').mask();
    }

    if ($('.date-time-picker')[0]) {
        $('.date-time-picker').datetimepicker();
    }

    if ($('.time-picker')[0]) {
        $('.time-picker').datetimepicker({
            format: 'LT'
        });
    }

    if ($('.date-picker')[0]) {
        $('.date-picker').datetimepicker({
            format: 'DD/MM/YYYY'
        });
    }

    if ($('.form-wizard-basic')[0]) {
        $('.form-wizard-basic').bootstrapWizard({
            tabClass: 'fw-nav',
            'nextSelector': '.next',
            'previousSelector': '.previous'
        });
    }

    function notify(message, type) {
        $.notify({
            message: message
        }, {
            type: type,
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
    };

    (function () {
        Waves.attach('.btn:not(.btn-icon):not(.btn-float)');
        Waves.attach('.btn-icon, .btn-float', ['waves-circle', 'waves-float']);
        Waves.init();
    })();

    $('body').on('click', '.a-prevent', function (e) {
        e.preventDefault();
    });

    if ($('.collapse')[0]) {

        //Add active class for opened items
        $('.collapse').on('show.bs.collapse', function (e) {
            $(this).closest('.panel').find('.panel-heading').addClass('active');
        });

        $('.collapse').on('hide.bs.collapse', function (e) {
            $(this).closest('.panel').find('.panel-heading').removeClass('active');
        });

        //Add active class for pre opened items
        $('.collapse.in').each(function () {
            $(this).closest('.panel').find('.panel-heading').addClass('active');
        });
    }

    if ($('[data-toggle="tooltip"]')[0]) {
        $('[data-toggle="tooltip"]').tooltip();
    }

    if ($('[data-toggle="popover"]')[0]) {
        $('[data-toggle="popover"]').popover();
    }

    if ($('.on-select')[0]) {
        var checkboxes = '.lv-avatar-content input:checkbox';
        var actions = $('.on-select').closest('.lv-actions');

        $('body').on('click', checkboxes, function () {
            if ($(checkboxes + ':checked')[0]) {
                actions.addClass('toggled');
            } else {
                actions.removeClass('toggled');
            }
        });
    }

    if ($('#ms-menu-trigger')[0]) {
        $('body').on('click', '#ms-menu-trigger', function (e) {
            e.preventDefault();
            $(this).toggleClass('open');
            $('.ms-menu').toggleClass('toggled');
        });
    }

    if ($('.login-content')[0]) {
        $('html').addClass('login-content');
        $('body').on('click', '.login-navigation > li', function () {
            var z = $(this).data('block');
            var t = $(this).closest('.lc-block');

            t.removeClass('toggled');

            setTimeout(function () {
                $(z).addClass('toggled');
            });

        });
    }

    if ($('[data-action="fullscreen"]')[0]) {
        var fs = $("[data-action='fullscreen']");
        fs.on('click', function (e) {
            e.preventDefault();
            function launchIntoFullscreen(element) {

                if (element.requestFullscreen) {
                    element.requestFullscreen();
                } else if (element.mozRequestFullScreen) {
                    element.mozRequestFullScreen();
                } else if (element.webkitRequestFullscreen) {
                    element.webkitRequestFullscreen();
                } else if (element.msRequestFullscreen) {
                    element.msRequestFullscreen();
                }
            }
            function exitFullscreen() {

                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                }
            }

            launchIntoFullscreen(document.documentElement);
            fs.closest('.dropdown').removeClass('open');
        });
    }

    if ($('html').hasClass('ie9')) {
        $('input, textarea').placeholder({
            customClass: 'ie9-placeholder'
        });
    }

    if ($('.lvh-search-trigger')[0]) {
        $('body').on('click', '.lvh-search-trigger', function (e) {
            e.preventDefault();
            x = $(this).closest('.lv-header-alt').find('.lvh-search');

            x.fadeIn(300);
            x.find('.lvhs-input').focus();
        });

        $('body').on('click', '.lvh-search-close', function () {
            x.fadeOut(300);
            setTimeout(function () {
                x.find('.lvhs-input').val('');
            }, 350);
        });
    }

    $('body').on('click', '[data-skin]', function () {
        var currentSkin = $('[data-current-skin]').data('current-skin');
        var skin = $(this).data('skin');

        $('[data-current-skin]').attr('data-current-skin', skin);

    });

});

/* Usage
 * $.strPad(12, 5); // returns 00012
 * $.strPad('abc', 6, '#'); // returns ###abc
 */
$.strPad = function (i, l, s) {
    var o = i.toString();
    if (!s) {
        s = '0';
    }
    while (o.length < l) {
        o = s + o;
    }
    return o;
};