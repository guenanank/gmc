<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gramedia Majalah Community</title>
    {{ Html::style('css/all.css') }}
    {{ Html::style('css/app.1.css') }}
    {{ Html::style('css/app.2.css') }}
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
                {{ link_to('#', 'Gramedia Majalah Community') }}
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
                        <li class="sub-menu">
                            {{ link_to('#', 'Residence') }}
                            <ul>
                                <li>{{ link_to('#', 'Countries') }}</li>
                                <li>{{ link_to('#', 'Provinces') }}</li>
                                <li>{{ link_to('#', 'Cities') }}</li>
                                <li>{{ link_to('#', 'Districts') }}</li>
                                <li>{{ link_to('#', 'Post Codes') }}</li>
                                <li>{{ link_to('#', 'Dwellings') }}</li>
                                <li>{{ link_to('#', 'Greater Areas') }}</li>
                            </ul>
                        </li>
                        <li>{{ link_to('master/source', 'Sources') }}</li>
                        <li class="sub-menu">
                            {{ link_to('#', 'Vehicles') }}
                            <ul>
                                <li>{{ link_to('#', 'Brands') }}</li>
                                <li>{{ link_to('#', 'Clasifications') }}</li>
                                <li>{{ link_to('#', 'Series') }}</li>
                                <li>{{ link_to('#', 'Types') }}</li>
                                <li>{{ link_to('#', 'Vehicles') }}</li>
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

    {{ Html::script('js/jquery.js') }}
    {{ Html::script('js/bootstrap.js') }}
    {{ Html::script('js/jquery.mCustomScrollbar.concat.min.js') }}
    {{ Html::script('js/waves.js') }}
    {{ Html::script('js/bootstrap-growl.js') }}
    {{ Html::script('js/sweet-alert.min.js') }}
    {{ Html::script('js/jquery.bootstrap.wizard.js') }}
    {{ Html::script('js/moment.js') }}
    {{ Html::script('js/bootstrap-select.js') }}
    {{ Html::script('js/jquery.nouislider.all.js') }}
    {{ Html::script('js/bootstrap-datetimepicker.min.js') }}
    {{ Html::script('js/typeahead.bundle.js') }}
    {{ Html::script('js/summernote.min.js') }}
    {{ Html::script('js/clipboard.min.js') }}
    {{ Html::script('js/chosen.jquery.js') }}
    {{ Html::script('js/input-mask.min.js') }}
    {{ Html::script('js/fileinput.min.js') }}
    {{ Html::script('js/jquery.bootgrid.updated.min.js') }}
    {{ Html::script('js/autosize.js') }}
    {{ Html::script('js/functions.js') }}
    
    <script type="text/javascript">
        
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
                
        var notify = function (message, type){
            $.growl({
                message: message
            },{
                type: type,
                offset: {
                    x: 20,
                    y: 85
                }
            });
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                _token: $('meta[name="csrf-token"]').attr('content')
            }
        });

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

    </script>
    {{ Html::script('js/ajaxForm.js') }}
    @section('scripts')

    @show
    <script type="text/javascript">
        console.info('Document length: ' + $('*').length);
    </script>
</body>
</html>