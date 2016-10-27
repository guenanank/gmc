<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<head>
    <base href="{{ url('/') }}" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Gramedia Majalah Community</title>
    {{ Html::style('css/all.css') }}
    {{ Html::style('css/app.1.css') }}
    {{ Html::style('css/app.2.css') }}
</head>

<body class="login-content">

    <div class="lc-block toggled" id="l-login">
        {{ Form::open(['url' => 'http://localhost/api/public/OAuth/in']) }}
        <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
            <div class="fg-line">
                {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username']) }}
            </div>
            <small class="help-block" id="username"></small>
        </div>

        <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-male"></i></span>
            <div class="fg-line">
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
            </div>
            <small class="help-block" id="password"></small>
        </div>

        <div class="clearfix"></div>

        <div class="checkbox">
            <label>
                {{ Form::checkbox('remember', true) }}
                <i class="input-helper"></i>
                Keep me signed in
            </label>
        </div>

        <button class="btn btn-login btn-danger btn-float" type="submit">
            <i class="zmdi zmdi-arrow-forward"></i>
        </button>

        <ul class="login-navigation">
            <li data-block="#l-forget-password" class="bgm-orange">Forgot Password?</li>
        </ul>
        {{ Form::close() }}
    </div>

    <div class="lc-block" id="l-forget-password">
        <p class="text-left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu risus. Curabitur commodo lorem fringilla enim feugiat commodo sed ac lacus.</p>
        {{ Form::open(['url' => 'http://localhost/api/public/OAuth/forget']) }}
        <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
            <div class="fg-line">
                {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email Address']) }}
            </div>
            <small class="help-block" id="email"></small>
        </div>

        <button class="btn btn-login btn-danger btn-float" type="submit">
            <i class="zmdi zmdi-arrow-forward"></i>
        </button>

        <ul class="login-navigation">
            <li data-block="#l-login" class="bgm-green">Login</li>
        </ul>
        {{ Form::close() }}
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

    <!-- Javascript Libraries -->
    {{ Html::script('js/jquery.min.js') }}
    {{ Html::script('js/bootstrap.min.js') }}

    {{ Html::script('js/waves.min.js') }}

    <!-- Placeholder for IE9 -->
    <!--[if IE 9 ]>
        {{ Html::script('js/jquery.placeholder.min.js') }}
    <![endif]-->

    {{ Html::script('js/app.js') }}

</body>
</html>