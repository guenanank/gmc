<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gramedia Majalah Community</title>
    <link rel="stylesheet" href="{{ asset('css/all.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.1.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.2.css') }}" />
    @section('styles')

    @show
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
                <a href="#">Gramedia Majalah Community</a>
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
                            <i class="tmn-counts">9</i>
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
                                                <img class="lv-img-sm" src="img/profile-pics/1.jpg" alt="">
                                            </div>
                                            <div class="media-body">
                                                <div class="lv-title">David Belle</div>
                                                <small class="lv-small">Cum sociis natoque penatibus et magnis dis parturient montes</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="lv-item" href="#">
                                        <div class="media">
                                            <div class="pull-left">
                                                <img class="lv-img-sm" src="img/profile-pics/2.jpg" alt="">
                                            </div>
                                            <div class="media-body">
                                                <div class="lv-title">Jonathan Morris</div>
                                                <small class="lv-small">Nunc quis diam diamurabitur at dolor elementum, dictum turpis vel</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="lv-item" href="#">
                                        <div class="media">
                                            <div class="pull-left">
                                                <img class="lv-img-sm" src="img/profile-pics/3.jpg" alt="">
                                            </div>
                                            <div class="media-body">
                                                <div class="lv-title">Fredric Mitchell Jr.</div>
                                                <small class="lv-small">Phasellus a ante et est ornare accumsan at vel magnauis blandit turpis at augue ultricies</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="lv-item" href="#">
                                        <div class="media">
                                            <div class="pull-left">
                                                <img class="lv-img-sm" src="img/profile-pics/4.jpg" alt="">
                                            </div>
                                            <div class="media-body">
                                                <div class="lv-title">Glenn Jecobs</div>
                                                <small class="lv-small">Ut vitae lacus sem ellentesque maximus, nunc sit amet varius dignissim, dui est consectetur neque</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="lv-item" href="#">
                                        <div class="media">
                                            <div class="pull-left">
                                                <img class="lv-img-sm" src="img/profile-pics/4.jpg" alt="">
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
    <section id="main">
        <aside id="sidebar" class="sidebar c-overflow">
            <div class="profile-menu">
                <a href="#">
                    <div class="profile-pic">
                        <img src="{{ asset('images/profile-pics/1.jpg') }}" alt="">
                    </div>

                    <div class="profile-info">
                        Malinda Hollaway <i class="zmdi zmdi-caret-down"></i>
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
                        <a href="#"><i class="zmdi zmdi-time-restore"></i> Logout</a>
                    </li>
                </ul>
            </div>

            <ul class="main-menu">
                <li><a href="{{ url('dashboard/') }}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
                <li class="sub-menu">
                    <a href="{{ url('#') }}"><i class="zmdi zmdi-accounts-list"></i> Audiences</a>
                    <ul>
<!--                        <li><a href="{{ url('audience/audienceType/') }}">Types</a></li>-->
                        <li><a href="{{ url('audience/layerQuestion') }}">Layer Questions</a></li>
                        <li><a href="{{ url('audience/audience/') }}">Audiences</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="#"><i class="zmdi zmdi-layers"></i> Master Data</a>
                    <ul>
                        <li><a href="{{ url('master/activity/') }}">Activities</a></li>
                        <li><a href="{{ url('master/education/') }}">Educations</a></li>
                        <li><a href="{{ url('master/expense/') }}">Expense</a></li>
                        <li><a href="{{ url('master/hobby/') }}">Hobbies</a></li>
                        <li><a href="{{ url('master/interest') }}">Interests</a></li>
                        <li><a href="{{ url('master/media') }}">Media</a></li>
                        <li><a href="{{ url('master/mediaGroup') }}">Media Groups</a></li>
                        <li><a href="{{ url('master/profession') }}">Professions</a></li>
                        <li class="sub-menu">
                            <a href="{{ '#' }}">Residence</a>
                            <ul>
                                <li><a href="#">Countries</a></li>
                                <li><a href="#">Provinces</a></li>
                                <li><a href="#">Cities</a></li>
                                <li><a href="#">Districts</a></li>
                                <li><a href="#">Post Codes</a></li>
                                <li><a href="#">Dwellings</a></li>
                                <li><a href="#">Greater Areas</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ url('master/source') }}">Sources</a></li>
                        <li class="sub-menu">
                            <a href="{{ '#' }}">Vehicles</a>
                            <ul>
                                <li><a href="#">Brands</a></li>
                                <li><a href="#">Clasifications</a></li>
                                <li><a href="#">Series</a></li>
                                <li><a href="#">Types</a></li>
                                <li><a href="#">Vehicles</a></li>
                            </ul>
                        </li>
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

    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/waves.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-growl.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/sweet-alert.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/moment.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-select.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.nouislider.all.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/typeahead.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/summernote.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/chosen.jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/input-mask.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/fileinput.min.js') }}"></script>

    <!--<script type="text/javascript" src="{{ asset('js/jquery.bootgrid.js') }}"></script>-->
    <script type="text/javascript" src="{{ asset('js/jquery.bootgrid.updated.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/functions.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/demo.js') }}"></script>

    <script type="text/javascript">
        (function ($) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    _token: $('meta[name="csrf-token"]').attr('content')
                }
            });
        })(jQuery);
    </script>
    @section('scripts')

    @show

</body>
</html>