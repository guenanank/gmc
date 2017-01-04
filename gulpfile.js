var gulp = require('gulp');
var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
var bower = 'vendor/bower_dl/';
var paths = {
    // Default
    jQuery: bower + 'jquery/dist/',
    bootstrap: bower + 'bootstrap/dist/',
    moment: bower + 'moment/min/',
    waves: bower + 'Waves/dist/',
    notify: bower + 'remarkable-bootstrap-notify/dist/',
    sweetAlert: bower + 'sweetalert/',
    mouseWheel: bower + 'jquery-mousewheel/',
    customScrollbar: 'malihu-custom-scrollbar-plugin/',
    iconicFont: bower + 'material-design-iconic-font/dist/',
    animateCss: bower + 'animate.css/',
    bootgrid: bower + 'jquery.bootgrid/dist/',
    // Chart
    flot: bower + 'flot/',
    curvedLines: bower + 'flot.curvedlines/',
    requireJs: bower + 'requirejs/',
    easyPie: bower + 'jquery.easy-pie-chart/dist/',
    sparkLine: bower + 'sparkline/src/',
    // Form
    select: bower + 'bootstrap-select/dist/',
    nouislider: bower + 'nouislider/distribute/',
    dateTimePicker: bower + 'eonasdan-bootstrap-datetimepicker/build/',
    placeHolder: bower + 'jquery-placeholder/',
    autoSize: bower + 'autosize/dist/',
    dropZone: bower + 'dropzone/dist/min/',
    wizard: bower + 'twitter-bootstrap-wizard/',
    clipboard: bower + 'clipboard/dist/',
};

elixir(function (mix) {

    mix.copy('resources/assets/fonts/**', 'public/fonts');
    mix.copy('resources/assets/images/**', 'public/images');

    mix.styles([
        // Default
        paths.animateCss + 'animate.css',
        paths.sweetAlert + 'dist/sweetalert.css',
        paths.sweetAlert + 'themes/google/google.css',
        paths.iconicFont + 'css/material-design-iconic-font.css',
        paths.dateTimePicker + 'css/bootstrap-datetimepicker.min.css',
        paths.bootgrid + 'jquery.bootgrid.min.css',
        paths.customScrollbar + 'jquery.mCustomScrollbar.min.css',
        //Form
        paths.select + 'css/bootstrap-select.min.css',
        paths.dropZone + 'dropzone.min.css',
        paths.nouislider + 'nouislider.min.css'
    ], null, bower);

    mix.copy(paths.iconicFont + 'fonts/**', 'public/fonts');

    mix.styles('app.1.css');
    mix.styles('app.2.css');

    // Default
    mix.scripts(paths.jQuery + 'jquery.min.js', null, bower);
    mix.scripts(paths.bootstrap + 'js/bootstrap.min.js', null, bower);
    //mix.scripts(paths.bootgrid + 'jquery.bootgrid.min.js', null, bower);
    mix.scripts('resources/assets/js/jquery.bootgrid.updated.min.js', 'public/js/jquery.bootgrid.min.js');
    mix.scripts(paths.moment + 'moment-with-locales.min.js', null, bower);
    mix.scripts(paths.waves + 'waves.min.js', null, bower);
    mix.scripts(paths.notify + 'bootstrap-notify.min.js', null, bower);
    mix.scripts(paths.sweetAlert + 'dist/sweetalert.min.js', null, bower);
    mix.scripts(paths.mouseWheel + 'jquery.mousewheel.min.js', null, bower);
    mix.scripts(paths.customScrollbar + 'jquery.mCustomScrollbar.concat.min.js', null, bower);

    // Form
    mix.scripts(paths.select + 'js/bootstrap-select.min.js', null, bower);
    mix.scripts(paths.nouislider + 'nouislider.min.js', null, bower);
    mix.scripts(paths.placeHolder + 'jquery.placeholder.min.js', null, bower);
    mix.scripts('resources/assets/js/input-mask.min.js', 'public/js/input-mask.min.js');
    mix.scripts(paths.autoSize + 'autosize.min.js', null, bower);
    mix.scripts(paths.dropZone + 'dropzone.min.js', null, bower);
    mix.scripts(paths.wizard + 'jquery.bootstrap.wizard.min.js', null, bower);
    mix.scripts(paths.clipboard + 'clipboard.min.js', null, bower);

    //Chart
    mix.scripts(paths.flot + 'jquery.flot.js', null, bower);
    mix.scripts(paths.flot + 'jquery.flot.resize.js', null, bower);
    mix.scripts(paths.curvedLines + 'curvedLines.js', null, bower);
    mix.scripts(paths.requireJs + 'require.js', null, bower);
    //mix.scriptsIn(paths.sparkLine, 'public/js/sparkline.js', bower);
    mix.scripts('resources/assets/js/jquery.sparkline.min.js', 'public/js');
    mix.scripts(paths.easyPie + 'jquery.easypiechart.min.js', null, bower);
    mix.scripts('resources/assets/js/flot-charts/curved-line-chart.js', 'public/js');
    mix.scripts('resources/assets/js/flot-charts/line-chart.js', 'public/js');
    mix.scripts('resources/assets/js/charts.js', 'public/js');

    mix.browserify('app.js');
    mix.browserify('ajaxForm.js');
    mix.browserify('validateAudience.js');
    mix.browserify('question.js');
    mix.browserify('regions.js');
});