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
var bowerComponents = 'vendor/bower_components/';
var paths = {
    jquery: bowerComponents + 'jquery/dist/',
    bootstrap: bowerComponents + 'bootstrap/dist/',
    fullcalendar: bowerComponents + 'fullcalendar/',
    animate: bowerComponents + 'animate.css/',
    sweetAlert: bowerComponents + 'bootstrap-sweetalert/lib/',
    growl: bowerComponents + 'remarkable-bootstrap-notify/dist/',
    materialDesignIconicFont: bowerComponents + 'material-design-iconic-font/dist/',
    malihuCustomScrollbarPlugin: bowerComponents + 'malihu-custom-scrollbar-plugin/',
    waves: bowerComponents + 'Waves/dist/',
    autosize: bowerComponents + 'autosize/dist/',
    bootstrapSelect: bowerComponents + 'bootstrap-select/dist/',
    nouislider: bowerComponents + 'nouislider/distribute/',
    bootstrapDatetimePicker: bowerComponents + 'eonasdan-bootstrap-datetimepicker/build/',
    chosen: bowerComponents + 'chosen/',
    summernote: bowerComponents + 'summernote/build/',
    typeheadJs: bowerComponents + 'typeahead.js/dist/',
    moment: bowerComponents + 'moment/',
    bootgrid: bowerComponents + 'jquery.bootgrid/dist/',
    bootstrapWizard: bowerComponents + 'twitter-bootstrap-wizard/'
};

elixir(function (mix) {
    mix.copy('resources/assets/fonts/materialAdmin/**', 'public/fonts');
    mix.copy('resources/assets/images/materialAdmin/**', 'public/images');
    
    mix.styles([
        paths.animate + 'animate.css',
        paths.sweetAlert + 'sweet-alert.css',
        paths.materialDesignIconicFont + 'css/material-design-iconic-font.css',
        paths.malihuCustomScrollbarPlugin + 'jquery.mCustomScrollbar.css',
        paths.bootstrapSelect + 'css/bootstrap-select.css',
        paths.nouislider + 'jquery.nouislider.min.css',
        paths.bootstrapDatetimePicker + 'css/bootstrap-datetimepicker.css',
        paths.chosen + 'chosen.css',
        paths.summernote + 'summernote.css',
        paths.bootgrid + 'jquery.bootgrid.css'
    ], null, bowerComponents);
    
    mix.copy(paths.materialDesignIconicFont + 'fonts/**', 'public/fonts');
    
    mix.styles('materialAdmin/app.1.css');
    mix.styles('materialAdmin/app.2.css');
    
    mix.scripts(paths.jquery + 'jquery.js', null, bowerComponents);
    mix.scripts(paths.bootstrap + 'js/bootstrap.js', null, bowerComponents);
    mix.scripts(paths.malihuCustomScrollbarPlugin + 'jquery.mCustomScrollbar.concat.min.js', null, bowerComponents);
    mix.scripts(paths.waves + 'waves.js', null, bowerComponents);
    mix.scripts(paths.growl + 'bootstrap-growl.js', null, bowerComponents);
    mix.scripts(paths.sweetAlert + 'sweet-alert.js', null, bowerComponents);
    mix.scripts(paths.autosize + 'autosize.js', null, bowerComponents);
    mix.scripts(paths.bootstrapSelect + 'js/bootstrap-select.js', null, bowerComponents);
    mix.scripts(paths.nouislider + 'jquery.nouislider.all.js', null, bowerComponents);
    mix.scripts(paths.bootstrapDatetimePicker + 'js/bootstrap-datetimepicker.min.js', null, bowerComponents);
    mix.scripts(paths.typeheadJs + 'typeahead.bundle.js', null, bowerComponents);
    mix.scripts(paths.typeheadJs + 'bloodhound.js', null, bowerComponents);
    mix.scripts(paths.summernote + 'summernote.min.js', null, bowerComponents);
    mix.scripts(paths.moment + 'moment.js', null, bowerComponents);
    mix.scripts(paths.chosen + 'chosen.jquery.js', null, bowerComponents);
    mix.scripts(paths.bootgrid + 'jquery.bootgrid.js', null, bowerComponents);
    mix.scripts(paths.bootstrapWizard + 'jquery.bootstrap.wizard.js', null, bowerComponents);
    
    mix.browserify('resources/assets/js/materialAdmin/fileinput.min.js', 'public/js');
    mix.browserify('resources/assets/js/materialAdmin/input-mask.min.js', 'public/js');
    mix.browserify('resources/assets/js/materialAdmin/jquery.bootgrid.updated.min.js', 'public/js');
    
    mix.browserify('materialAdmin/functions.js');
    mix.browserify('materialAdmin/demo.js');
});