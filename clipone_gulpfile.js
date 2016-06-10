var gulp = require('gulp');
var rename = require('gulp-rename');
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

var npmModules = '';
var bowerComponents = 'vendor/bower_components/';
var paths = {
    jquery: bowerComponents + 'jquery/',
    bootstrap: bowerComponents + 'bootstrap/dist/',
    jqueryUi: bowerComponents + 'jquery-ui/',
    autosize: bowerComponents + 'autosize/',
    blueimpCanvasToBlob: bowerComponents + 'blueimp-canvas-to-blob/js/',
    blueimpFileUpload: bowerComponents + 'blueimp-file-upload/',
    blueimpLoadImage: bowerComponents + 'blueimp-load-image/js/',
    blueimpTmpl: bowerComponents + 'blueimp-tmpl/js/',
    blockUI: bowerComponents + 'blockUI/',
    bootstrapColorpicker: bowerComponents + 'mjolnic-bootstrap-colorpicker/dist/',
    bootstrapDatepicker: bowerComponents + 'bootstrap-datepicker/',
    bootstrapHoverDropdown: bowerComponents + 'bootstrap-hover-dropdown/',
    bootstrapModal: bowerComponents + 'bootstrap-modal/',
    bootstrapSwitch: bowerComponents + 'bootstrap-switch/src/',
    bootstrapDatetimepicker: bowerComponents + 'eonasdan-bootstrap-datetimepicker/build/',
    bootstrapDaterangepicker: bowerComponents + 'bootstrap-daterangepicker/',
    bootstrapTimepicker: bowerComponents + 'bootstrap-timepicker/',
    ckeditor: bowerComponents + 'ckeditor/',
    colorbox: bowerComponents + 'jquery-colorbox/',
    dropzone: bowerComponents + 'dropzone/dist/',
    dataTables: bowerComponents + 'datatables.net/js/',
    dataTablesBootstrap: bowerComponents + 'datatables.net-bs/',
    fontAwesome: bowerComponents + 'font-awesome/',
    fullcalendar: bowerComponents + 'fullcalendar/dist/',
    ExplorerCanvas: bowerComponents + 'ExplorerCanvas/',
    gritter: bowerComponents + 'gritter/',
    iCheck: bowerComponents + 'iCheck/',
    Jcrop: bowerComponents + 'Jcrop/src/',
    jqGrid: bowerComponents + 'jqGrid/',
    jqueryAddress: bowerComponents + 'jquery-address/src/',
    jqueryCookie: bowerComponents + 'jquery.cookie/',
    jqueryInputlimiter: bowerComponents + 'jquery-inputlimiter/',
    jqueryMaskedinput: bowerComponents + 'jquery.maskedinput/dist/',
    jqueryMaskmoney: bowerComponents + 'jquery-maskmoney/',
    jqueryMockjax: bowerComponents + 'jquery-mockjax/',
    jqueryMouseWheel: bowerComponents + 'jquery-mousewheel/',
    jquerySmartWizard: bowerComponents + 'jQuery-Smart-Wizard/',
    jqueryTagsinput: bowerComponents + 'jquery.tagsinput/src/',
    jqueryUiTouchPunch: bowerComponents + 'jquery-ui-touch-punch/',
    jqueryValidation: bowerComponents + 'jquery-validation/',
    less: bowerComponents + 'less/dist/',
    ladda: bowerComponents + 'ladda/dist/',
    moment: bowerComponents + 'moment/',
    select2: bowerComponents + 'select2/',
    summernote: bowerComponents + 'summernote/build/',
    perfectScrollbar: bowerComponents + 'perfect-scrollbar/',
    typeaheadJs: bowerComponents + 'typeahead.js/dist/',
    wysihtml5x: bowerComponents + 'wysihtml5x/dist/',
    xEditable: bowerComponents + 'x-editable/dist/'
};

elixir(function (mix) {

    mix.copy('resources/assets/fonts/**', 'public/fonts');
    mix.copy('resources/assets/images/**', 'public/images');

    // default setting
    mix.copy(paths.jquery + 'jquery.min.js', 'public/js');
    mix.copy(paths.bootstrap, 'public/plugins/bootstrap');
    mix.copy(paths.fontAwesome + 'css/font-awesome.min.css', 'public/plugins/fontAwesome/css');
    mix.copy(paths.fontAwesome + 'fonts/**', 'public/plugins/fontAwesome/fonts');
    mix.copy(paths.jqueryUi + 'themes/**', 'public/plugins/jqueryUi');
    mix.copy(paths.jqueryUi + 'ui/**', 'public/plugins/jqueryUi');
    mix.copy(paths.bootstrapHoverDropdown + 'bootstrap-hover-dropdown.min.js', 'public/plugins/bootstrapHoverDropdown');
    mix.copy(paths.blockUI + 'jquery.blockUI.js', 'public/plugins/blockUI');
    mix.copy(paths.iCheck + 'skins/**', 'public/plugins/iCheck');
    mix.copy(paths.iCheck + 'icheck.min.js', 'public/plugins/iCheck');
    mix.copy(paths.jqueryMouseWheel + 'jquery.mousewheel.min.js', 'public/plugins/jqueryMouseWheel');
    mix.copy(paths.perfectScrollbar + 'min/**', 'public/plugins/perfectScrollbar');
    mix.copy(paths.less + 'less-1.5.0.min.js', 'public/plugins/less');
    mix.copy(paths.jqueryCookie + 'jquery.cookie.js', 'public/plugins/jqueryCookie');
    
    mix.copy(paths.bootstrapModal + 'css/**', 'public/plugins/bootstrapModal/css');
    mix.copy(paths.bootstrapModal + 'js/**', 'public/plugins/bootstrapModal/js');
    mix.copy(paths.bootstrapModal + 'img/**', 'public/plugins/bootstrapModal/img');

    // form element
    mix.copy(paths.jqueryInputlimiter + 'jquery.inputlimiter.css', 'public/plugins/jqueryInputlimiter');
    mix.copy(paths.jqueryInputlimiter + 'jquery.inputlimiter.js', 'public/plugins/jqueryInputlimiter');
    mix.copy(paths.autosize + 'jquery.autosize.min.js', 'public/plugins/autosize');
    mix.copy(paths.jqueryMaskedinput + 'jquery.maskedinput.min.js', 'public/plugins/jqueryMaskedinput');
    mix.copy(paths.jqueryMaskmoney + 'jquery.maskMoney.js', 'public/plugins/jqueryMaskmoney');
    mix.copy(paths.select2, 'public/plugins/select2');
    mix.copy(paths.bootstrapDatepicker + 'css/**', 'public/plugins/bootstrapDatepicker');
    mix.copy(paths.bootstrapDatepicker + 'js/**', 'public/plugins/bootstrapDatepicker');
    mix.copy(paths.bootstrapTimepicker + 'css/**', 'public/plugins/bootstrapTimepicker');
    mix.copy(paths.bootstrapTimepicker + 'js/**', 'public/plugins/bootstrapTimepicker');
    mix.copy(paths.bootstrapDaterangepicker + 'daterangepicker-bs3.css', 'public/plugins/bootstrapDaterangepicker');
    mix.copy(paths.bootstrapDaterangepicker + 'daterangepicker.js', 'public/plugins/bootstrapDaterangepicker');
    mix.copy(paths.jqueryTagsinput + 'jquery.tagsinput.css', 'public/plugins/jqueryTagsinput');
    mix.copy(paths.jqueryTagsinput + 'jquery.tagsinput.js', 'public/plugins/jqueryTagsinput');
//    mix.copy(paths.blueimpTmpl + 'tmpl.min.js', 'public/plugins/bootstrapFileupload');
//    mix.copy(paths.blueimpLoadImage + 'load-image.all.min.js', 'public/plugins/bootstrapFileupload');
//    mix.copy(paths.blueimpCanvasToBlob + 'canvas-to-blob.min.js', 'public/plugins/bootstrapFileupload');
//    mix.copy(paths.blueimpFileUpload + 'jquery.fileupload.js', 'public/plugins/bootstrapFileupload');
    mix.copy(paths.summernote + 'summernote-bootstrap.css', 'public/plugins/summernote');
    mix.copy(paths.summernote + 'summernote.css', 'public/plugins/summernote');
    mix.copy(paths.summernote + 'summernote.min.js', 'public/plugins/summernote');

    // form wizard
    mix.copy(paths.jqueryValidation + 'localization/**', 'public/plugins/jqueryValidation/localization');
    mix.copy(paths.jqueryValidation + 'jquery.validate.js', 'public/plugins/jqueryValidation');
    mix.copy(paths.jquerySmartWizard + 'images/loader.gif', 'public/plugins/jquerySmartWizard/images');
    mix.copy(paths.jquerySmartWizard + 'js/jquery.smartWizard.js', 'public/plugins/jquerySmartWizard/js');
    mix.copy(paths.jquerySmartWizard + 'styles/smart_wizard.css', 'public/plugins/jquerySmartWizard/css');
    mix.copy(paths.jquerySmartWizard + 'styles/smart_wizard_vertical.css', 'public/plugins/jquerySmartWizard/css');
    
    // form x-editable
    mix.copy(paths.jqueryMockjax + 'jquery.mockjax.js', 'public/plugins/jqueryMockjax');
    mix.copy(paths.typeaheadJs + 'typeahead.min.js', 'public/plugins/typeaheadJs');
    mix.copy(paths.moment + 'lang/**', 'public/plugins/moment');
    mix.copy(paths.moment + 'min/moment+langs.min.js', 'public/plugins/moment/js');
    mix.copy(paths.xEditable + 'bootstrap3-editable/**', 'public/plugins/xEditable');
    
    // form validation
    mix.copy(paths.jqueryValidation + 'jquery.validate.js', 'public/plugins/jqueryValidation');
    mix.copy(paths.jqueryValidation + 'localization/**', 'public/plugins/jqueryValidation/localization');
    
    mix.styles('fonts.css');
    mix.styles('main.css');
    mix.styles('main-responsive.css');
    mix.styles('theme_black_and_white.css');
    mix.styles('bootstrap-modal-bs3patch.css', 'public/plugins/bootstrapModal/css');
    mix.styles('print.css');

    mix.scripts('main.js');
    mix.scripts('form-elements.js');
    mix.scripts('form-wizard.js');

});