<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<head>
    <base href="{{ url('/') }}" />
    {{ Html::favicon('http://kompasgramedia.com/favicon.png') }}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Gramedia Majalah Community</title>
    {{ Html::style('css/all.css') }}
    {{ Html::style('css/app.1.css') }}
    {{ Html::style('css/app.2.css') }}
    @stack('styles')
</head>
<body>
    <header id="header" class="clearfix" data-current-skin="blue">
        <ul class="header-inner">
            <li id="menu-trigger" data-trigger="#sidebar">
                <div class="line-wrap">
                    <div class="line top"></div>
                    <div class="line center"></div>
                    <div class="line bottom"></div>
                </div>
            </li>

            <li class="logo hidden-xs">
                {{ link_to('dashboard', 'Gramedia Majalah Community') }}
            </li>

            <li class="pull-right">
                <ul class="top-menu">
                    <li id="toggle-width">
                        <div class="toggle-switch">
                            <input id="tw-switch" type="checkbox" hidden="hidden">
                            <label for="tw-switch" class="ts-helper"></label>
                        </div>
                    </li>

                    <li id="top-search">
                        <a href="#"><i class="tm-icon zmdi zmdi-search"></i></a>
                    </li>

                    <li class="dropdown">
                        <a data-toggle="dropdown" href="#">
                            <i class="tm-icon zmdi zmdi-notifications"></i>
                            <i class="tmn-counts">1</i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg pull-right">
                            <div class="listview" id="notifications">
                                <div class="lv-header">
                                    Notification
                                    <ul class="actions">
                                        <li class="dropdown">
                                            <a href="#" data-clear="notification">
                                                <i class="zmdi zmdi-check-all"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="lv-body">
                                    <a class="lv-item" href="#">
                                        <div class="media">
                                            <div class="pull-left">
                                                <img class="lv-img-sm" src="{{ asset('images/profile-pics/2.jpg') }}" alt="">
                                            </div>
                                            <div class="media-body">
                                                <div class="lv-title">Bill Phillips</div>
                                                <small class="lv-small">Proin laoreet commodo eros id faucibus. Donec ligula quam, imperdiet vel ante placerat</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <a class="lv-footer" href="#">View Previous</a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a data-toggle="dropdown" href="#"><i class="tm-icon zmdi zmdi-more-vert"></i></a>
                        <ul class="dropdown-menu dm-icon pull-right">
                            <li class="skin-switch hidden-xs">
                                <span class="ss-skin bgm-lightblue" data-skin="lightblue"></span>
                                <span class="ss-skin bgm-bluegray" data-skin="bluegray"></span>
                                <span class="ss-skin bgm-cyan" data-skin="cyan"></span>
                                <span class="ss-skin bgm-teal" data-skin="teal"></span>
                                <span class="ss-skin bgm-orange" data-skin="orange"></span>
                                <span class="ss-skin bgm-blue" data-skin="blue"></span>
                            </li>
                            <li class="divider hidden-xs"></li>
                            <li class="hidden-xs">
                                <a data-action="fullscreen" href="#"><i class="zmdi zmdi-fullscreen"></i> Toggle Fullscreen</a>
                            </li>
                            <li>
                                <a data-action="clear-localstorage" href="#"><i class="zmdi zmdi-delete"></i> Clear Local Storage</a>
                            </li>
                            <li>
                                <a href="#"><i class="zmdi zmdi-face"></i> Privacy Settings</a>
                            </li>
                            <li>
                                <a href="#"><i class="zmdi zmdi-settings"></i> Other Settings</a>
                            </li>
                        </ul>
                    </li>
                    <li class="hidden-xs" id="chat-trigger" data-trigger="#chat">
                        <a href="#"><i class="tm-icon zmdi zmdi-comment-alt-text"></i></a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Top Search Content -->
        <div id="top-search-wrap">
            <div class="tsw-inner">
                <i id="top-search-close" class="zmdi zmdi-arrow-left"></i>
                <input type="text">
            </div>
        </div>
    </header>
    <section id="main" data-layout="layout-1">
        <aside id="sidebar" class="sidebar c-overflow">
            <div class="profile-menu">
                <a href="#">
                    <div class="profile-pic">
                        <img src="{{ asset('images/profile-pics/1.jpg') }}" alt="">
                    </div>
                    <div class="profile-info">
                        {{ Request::session()->get('employee_name') }} <i class="zmdi zmdi-caret-down"></i>
                    </div>
                </a>
                <ul class="main-menu">
                    <li>
                        <a href="profile-about.html"><i class="zmdi zmdi-account"></i> View Profile</a>
                    </li>
                    <li>
                        <a href="#"><i class="zmdi zmdi-input-antenna"></i> Privacy Settings</a>
                    </li>
                    <li>
                        <a href="#"><i class="zmdi zmdi-settings"></i> Settings</a>
                    </li>
                    <li>
                        <a href="{{ url('/logout') }}"><i class="zmdi zmdi-time-restore"></i> Logout</a>
                    </li>
                </ul>
            </div>
            <ul class="main-menu">
                <li><a href="{{ url('dashboard/') }}"><i class="zmdi zmdi-view-dashboard"></i> Dashboard</a></li>
                <li class="sub-menu">
                    <a href="{{ url('#') }}"><i class="zmdi zmdi-accounts-list"></i> Audiences</a>
                    <ul>
                        <li>{{ link_to('layerQuestion', 'Layer Questions') }}</li>
                        <li>{{ link_to('audience', 'Audiences') }}</li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="#"><i class="zmdi zmdi-layers"></i> Master Data</a>
                    <ul>
                        <li>{{ link_to('activity', 'Activities') }}</li>
                        <li>{{ link_to('education', 'Education') }}</li>
                        <li>{{ link_to('expense', 'Expenses') }}</li>
                        <li>{{ link_to('hobby', 'Hobbies') }}</li>
                        <li>{{ link_to('interest', 'Interests') }}</li>
                        <li>{{ link_to('media', 'Media') }}</li>
                        <li>{{ link_to('mediaGroup', 'Media Groups') }}</li>
                        <li>{{ link_to('profession', 'Professions') }}</li>
                        <li>{{ link_to('greaterArea', 'Greater Areas') }}</li>
                        <li>{{ link_to('source', 'Sources') }}</li>
                        <li>{{ link_to('vehicle', 'Vehicle') }}</li>
                    </ul>
                </li>
            </ul>
        </aside>

        <section id="content">
            <div class="container">
                @section('breadcrumb')

                @show
                <div class="block-header">
                    @section('blockHeader')

                    @show
                </div>
                @yield('content')
            </div>
        </section>
    </section>
    <footer id="footer">
        Copyright &copy; {{ date('Y') }} Gramedia Majalah
    </footer>

    <!-- Page Loader -->
    <div class="page-loader">
        <div class="preloader pls-blue">
            <svg class="pl-circular" viewBox="25 25 50 50">
            <circle class="plc-path" cx="50" cy="50" r="20" />
            </svg>

            <p>Please wait...</p>
        </div>
    </div>

    <!-- Older IE warning message -->
    <!--[if lt IE 9]>
        <div class="ie-warning">
            <h1 class="c-white">Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="img/browsers/chrome.png" alt="">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="img/browsers/firefox.png" alt="">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="img/browsers/opera.png" alt="">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="img/browsers/safari.png" alt="">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="img/browsers/ie.png" alt="">
                            <div>IE (New)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>   
    <![endif]-->

    <!-- Default -->
    {{ Html::script('js/jquery.min.js') }}
    {{ Html::script('js/bootstrap.min.js') }}
    {{ Html::script('js/jquery.bootgrid.min.js') }}
    {{ Html::script('js/moment-with-locales.min.js') }}
    {{ Html::script('js/waves.min.js') }}
    {{ Html::script('js/bootstrap-notify.min.js') }}
    {{ Html::script('js/sweetalert.min.js') }}
    {{ Html::script('js/jquery.mousewheel.min.js') }}
    {{ Html::script('js/jquery.mCustomScrollbar.concat.min.js') }}

    <!-- Form -->
    {{ Html::script('js/bootstrap-select.min.js') }}
    {{ Html::script('js/nouislider.min.js') }}
    {{ Html::script('js/jquery.placeholder.min.js') }}
    {{ Html::script('js/autosize.min.js') }}

    {{ Html::script('js/app.js') }}
    {{ Html::script('js/ajaxForm.js') }}

    <!-- Placeholder for IE9 -->
    <!--[if IE 9 ]>
        {{ Html::script('js/jquery.placeholder.min.js') }}
    <![endif]-->

    <script type="text/javascript">
        (function ($) {
            $('form.ajaxForm').submit(function (e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                $(this).ajaxForm();
            });

            var deletes = function (controller, id) {
                swal({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this file!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    $.post(controller + '/' + id, {_method: 'DELETE'}, function () {
                        swal({
                            title: 'Deleted!',
                            text: 'Your file has been deleted.',
                            type: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        $('#bootgrid').bootgrid('reload');
                    });
                });
            };
        })(jQuery);
    </script>

    @stack('scripts')
    <script type="text/javascript">
        console.info('Document length: ' + $('*').length);
    </script>
</body>
</html>