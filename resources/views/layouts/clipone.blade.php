<!DOCTYPE html>
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
    <!--<![endif]-->
    <!-- start: HEAD -->
    <head>
        <title>Gramedia Majalah Community</title>
        <meta charset="utf-8" />
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="Gramedia Majalah Community" name="description" />
        <meta content="nanank" name="author" />
        <!-- start: MAIN CSS -->
        <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/fontAwesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
        <link href="{{ asset('css/main-responsive.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/iCheck/all.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/perfectScrollbar/perfect-scrollbar-0.4.6.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/theme_black_and_white.css') }}" rel="stylesheet">
        <link href="{{ asset('css/print.css') }}" rel="stylesheet" media="print">
        <!-- end: MAIN CSS -->
        <!-- start: CSS DYNAMIC REQUIRED FOR THIS PAGE -->
        <link href="{{ asset('plugins/bootstrapModal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/bootstrapModal/css/bootstrap-modal.css') }}" rel="stylesheet">

        <link href="{{ asset('plugins/select2/select2.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/bootstrapDatepicker/datepicker.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/bootstrapTimepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/bootstrapDaterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/jqueryTagsinput/jquery.tagsinput.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/summernote/summernote-bootstrap.css') }}" rel="stylesheet">

        <link href="{{ asset('plugins/xEditable/css/bootstrap-editable.css') }}" rel="stylesheet">
        @section('styles')

        @show
        <!-- end: CSS DYNAMIC REQUIRED FOR THIS PAGE -->
    </head>
    <!-- end: HEAD -->
    <!-- start: BODY -->
    <body class="navigation-small">
        <!-- start: HEADER -->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <!-- start: TOP NAVIGATION CONTAINER -->
            <div class="container">
                <div class="navbar-header">
                    <!-- start: RESPONSIVE MENU TOGGLER -->
                    <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="clip-list-2"></span>
                    </button>
                    <!-- end: RESPONSIVE MENU TOGGLER -->
                    <!-- start: LOGO -->
                    <a class="navbar-brand" href="/dashboard">
                        <!--img src="{{ asset('images/logo.jpg') }}" /-->
                        CLIP<i class="clip-clip"></i>ONE
                    </a>
                    <!-- end: LOGO -->
                </div>
                <div class="navbar-tools">
                    <!-- start: TOP NAVIGATION MENU -->
                    <ul class="nav navbar-right">
                        <!-- start: NOTIFICATION DROPDOWN -->
                        <li class="dropdown">
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                                <i class="clip-notification-2"></i>
                                <span class="badge"> 11</span>
                            </a>
                            <ul class="dropdown-menu notifications">
                                <li>
                                    <span class="dropdown-menu-title"> You have 11 notifications</span>
                                </li>
                                <li>
                                    <div class="drop-down-wrapper">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="label label-primary"><i class="fa fa-user"></i></span>
                                                    <span class="message"> New user registration</span>
                                                    <span class="time"> 1 min</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="label label-success"><i class="fa fa-comment"></i></span>
                                                    <span class="message"> New comment</span>
                                                    <span class="time"> 7 min</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="label label-success"><i class="fa fa-comment"></i></span>
                                                    <span class="message"> New comment</span>
                                                    <span class="time"> 8 min</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="label label-success"><i class="fa fa-comment"></i></span>
                                                    <span class="message"> New comment</span>
                                                    <span class="time"> 16 min</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="label label-primary"><i class="fa fa-user"></i></span>
                                                    <span class="message"> New user registration</span>
                                                    <span class="time"> 36 min</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="label label-warning"><i class="fa fa-shopping-cart"></i></span>
                                                    <span class="message"> 2 items sold</span>
                                                    <span class="time"> 1 hour</span>
                                                </a>
                                            </li>
                                            <li class="warning">
                                                <a href="javascript:void(0)">
                                                    <span class="label label-danger"><i class="fa fa-user"></i></span>
                                                    <span class="message"> User deleted account</span>
                                                    <span class="time"> 2 hour</span>
                                                </a>
                                            </li>
                                            <li class="warning">
                                                <a href="javascript:void(0)">
                                                    <span class="label label-danger"><i class="fa fa-shopping-cart"></i></span>
                                                    <span class="message"> Transaction was canceled</span>
                                                    <span class="time"> 6 hour</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="label label-success"><i class="fa fa-comment"></i></span>
                                                    <span class="message"> New comment</span>
                                                    <span class="time"> yesterday</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="label label-primary"><i class="fa fa-user"></i></span>
                                                    <span class="message"> New user registration</span>
                                                    <span class="time"> yesterday</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="label label-primary"><i class="fa fa-user"></i></span>
                                                    <span class="message"> New user registration</span>
                                                    <span class="time"> yesterday</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="label label-success"><i class="fa fa-comment"></i></span>
                                                    <span class="message"> New comment</span>
                                                    <span class="time"> yesterday</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="label label-success"><i class="fa fa-comment"></i></span>
                                                    <span class="message"> New comment</span>
                                                    <span class="time"> yesterday</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="view-all">
                                    <a href="javascript:void(0)">
                                        See all notifications <i class="fa fa-arrow-circle-o-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- end: NOTIFICATION DROPDOWN -->
                        <!-- start: USER DROPDOWN -->
                        <li class="dropdown current-user">
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                                <img src="{{ asset('images/avatar-1-small.jpg') }}" class="circle-img" alt="">
                                <span class="username">Peter Clark</span>
                                <i class="clip-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="pages_user_profile.html">
                                        <i class="clip-user-2"></i>
                                        &nbsp;My Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="pages_calendar.html">
                                        <i class="clip-calendar"></i>
                                        &nbsp;My Calendar
                                    </a>
                                <li>
                                    <a href="pages_messages.html">
                                        <i class="clip-bubble-4"></i>
                                        &nbsp;My Messages (3)
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="utility_lock_screen.html"><i class="clip-locked"></i>
                                        &nbsp;Lock Screen </a>
                                </li>
                                <li>
                                    <a href="login_example1.html">
                                        <i class="clip-exit"></i>
                                        &nbsp;Log Out
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- end: USER DROPDOWN -->
                    </ul>
                    <!-- end: TOP NAVIGATION MENU -->
                </div>
            </div>
            <!-- end: TOP NAVIGATION CONTAINER -->
        </div>
        <!-- end: HEADER -->
        <!-- start: MAIN CONTAINER -->
        <div class="main-container">
            <div class="navbar-content">
                <!-- start: SIDEBAR -->
                <div class="main-navigation navbar-collapse collapse">
                    <!-- start: MAIN MENU TOGGLER BUTTON -->
                    <div class="navigation-toggler">
                        <i class="clip-chevron-left"></i>
                        <i class="clip-chevron-right"></i>
                    </div>
                    <!-- end: MAIN MENU TOGGLER BUTTON -->
                    <!-- start: MAIN NAVIGATION MENU -->
                    <ul class="main-navigation-menu">
                        <li class="active open">
                            <a href="/dashboard"><i class="clip-home-3"></i>
                                <span class="title"> Dashboard </span><span class="selected"></span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="clip-pyramid"></i>
                                <span class="title"> Masters </span><i class="icon-arrow"></i>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="education">Education</a></li>
                                <li><a href="expense">Expense</a></li>
                                <li><a href="hobby">Hobby</a></li>
                                <li><a href="interest">Interest</a></li>
                                <li><a href="media">Media</a></li>
                                <li><a href="mediaGroup">Media Group</a></li>
                                <li><a href="profession">Profession</a></li>
                                <li><a href="source">Source</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- end: MAIN NAVIGATION MENU -->
                </div>
                <!-- end: SIDEBAR -->
            </div>
            <div class="main-content">
                <!-- start: PANEL CONFIGURATION MODAL FORM -->
                <div class="modal fade" id="panel-config" tabindex="-1">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h4 class="modal-title">Panel Configuration</h4>
                        </div>
                        <div class="modal-body">
                            Here will be a configuration form
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary">
                                Save changes
                            </button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- end: SPANEL CONFIGURATION MODAL FORM -->
                <div class="container">
                    <!-- start: PAGE HEADER -->
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- start: PAGE TITLE & BREADCRUMB -->
                            <ol class="breadcrumb">
                                @section('breadcrumb')

                                @show
                                <li class="search-box">
                                    @section('searchBox')

                                    @show
                                </li>
                            </ol>
                            <div class="page-header">
                                @section('pageHeader')

                                @show
                            </div>
                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end: MAIN CONTAINER -->
        <!-- start: FOOTER -->
        <div class="footer clearfix">
            <div class="footer-inner">
                &copy; {{ date('Y') }} 
            </div>
            <div class="footer-items">
                <span class="go-top"><i class="clip-chevron-up"></i></span>
            </div>
        </div>
        <!-- end: FOOTER -->
        <!-- start: MAIN JAVASCRIPTS -->
        <!--[if lt IE 9]>
        <script src="assets/plugins/respond.min.js"></script>
        <script src="assets/plugins/excanvas.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <![endif]-->
        <!--[if gte IE 9]><!-->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <!--<![endif]-->
        <script src="{{ asset('plugins/jqueryUi/ui/minified/jquery-ui.custom.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrapHoverDropdown/bootstrap-hover-dropdown.min.js') }}"></script>
        <script src="{{ asset('plugins/blockUI/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
        <script src="{{ asset('plugins/jqueryMouseWheel/jquery.mousewheel.min.js') }}"></script>
        <script src="{{ asset('plugins/perfectScrollbar/perfect-scrollbar-0.4.6.min.js') }}"></script>
        <script src="{{ asset('plugins/less/less-1.5.0.min.js') }}"></script>
        <script src="{{ asset('plugins/jqueryCookie/jquery.cookie.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <!-- end: MAIN JAVASCRIPTS -->
        <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <script src="{{ asset('plugins/bootstrapModal/js/bootstrap-modal.js') }}"></script>
        <script src="{{ asset('plugins/bootstrapModal/js/bootstrap-modalmanager.js') }}"></script>

        <script src="{{ asset('plugins/jqueryInputlimiter/jquery.inputlimiter.js') }}"></script>
        <script src="{{ asset('plugins/autosize/jquery.autosize.min.js') }}"></script>
        <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('plugins/jqueryMaskedinput/jquery.maskedinput.min.js') }}"></script>
        <script src="{{ asset('plugins/jqueryMaskmoney/jquery.maskMoney.js') }}"></script>
        <script src="{{ asset('plugins/bootstrapDatepicker/bootstrap-datepicker.js') }}"></script>
        <script src="{{ asset('plugins/bootstrapTimepicker/bootstrap-timepicker.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrapDaterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('plugins/jqueryTagsinput/jquery.tagsinput.js') }}"></script>
        <script src="{{ asset('plugins/summernote/summernote.min.js') }}"></script>
        <script src="{{ asset('plugins/jqueryValidation/jquery.validate.js') }}"></script>
        <script src="{{ asset('js/form-elements.js') }}"></script>

        <script src="{{ asset('plugins/moment/js/moment+langs.min.js') }}"></script>
        <script src="{{ asset('plugins/xEditable/js/bootstrap-editable.min.js') }}"></script>
        <script src="{{ asset('plugins/typeaheadJs/typeahead.min.js') }}"></script>
        <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        @section('scripts')

        @show
        <script type="text/javascript">
            $(document).ready(function () {
                Main.init();
                FormElements.init();

                var createForm = $('.createForm');
                var errorHandler = $('.errorHandler', createForm);
                var successHandler = $('.successHandler', createForm);
                createForm.validate({
                    errorElement: 'span',
                    errorClass: 'help-block',
                    errorPlacement: function (error, element) {
                        if (element.attr("type") == "radio" || element.attr("type") == "checkbox") {
                            error.insertAfter($(element).closest('.form-group').children('div').children().last());
                        } else if (element.attr("name") == "dd" || element.attr("name") == "mm" || element.attr("name") == "yyyy") {
                            error.insertAfter($(element).closest('.form-group').children('div'));
                        } else {
                            error.insertAfter(element);
                        }
                    },
                    ignore: '',
                    rules: {
                    },
                    messages: {
                    },
                    invalidHandler: function (event, validator) {
                        successHandler.hide();
                        errorHandler.show();
                    },
                    highlight: function (element) {
                        $(element).closest('.help-block').removeClass('valid');
                        $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                    },
                    unhighlight: function (element) { 
                        $(element).closest('.form-group').removeClass('has-error');
                    },
                    success: function (label, element) {
                        label.addClass('help-block valid');
                        $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
                    },
                    submitHandler: function (form) {
                        successHandler.show();
                        errorHandler.hide();
                        // submit form
                        //$('#form').submit();
                    }
                });

            });
        </script>
    </body>
</html>