<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>OTP</title>

            <script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
			<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
            <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
            <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
			    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('js/app.js') }}" rel="stylesheet">


   <style>
/*.navbar-default {
    background-color: #ffffff !important;
    border-color: #ffffff !important;
}
.navbar-default .navbar-nav>li>a, .navbar-default .navbar-text {
    color: #fff;
}
.navbar-default .navbar-brand {
    color: #fff;
}


body {
   
    color: #525f7f;
    background-color: #1e1e2f;
}*/


/*.btn-primary {
    background: #e14eca;
    background-image: -webkit-linear-gradient(to bottom left, #e14eca, #ba54f5, #e14eca);
    background-image: -o-linear-gradient(to bottom left, #e14eca, #ba54f5, #e14eca);
    background-image: -moz-linear-gradient(to bottom left, #e14eca, #ba54f5, #e14eca);
    background-image: linear-gradient(to bottom left, #e14eca, #ba54f5, #e14eca);
    background-size: 210% 210%;
    background-position: top right;
    background-color: #e14eca;
    transition: all 0.15s ease;
    box-shadow: none;
    color: #ffffff;
    border-color: #e14eca;
}

.btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .btn-primary:active:focus, .btn-primary:active:hover, .btn-primary.active:focus, .btn-primary.active:hover {
    background-color: #ba54f5 !important;
    background-image: linear-gradient(to bottom left, #e14eca, #ba54f5, #e14eca) !important;
    background-image: -webkit-linear-gradient(to bottom left, #e14eca, #ba54f5, #e14eca) !important;
    background-image: -o-linear-gradient(to bottom left, #e14eca, #ba54f5, #e14eca) !important;
    background-image: -moz-linear-gradient(to bottom left, #e14eca, #ba54f5, #e14eca) !important;
    color: #ffffff;
    box-shadow: none;
    border-color: #e14eca;
}
.navbar-default .navbar-brand:focus, .navbar-default .navbar-brand:hover {
    color: #ffffff;
    background-color: transparent;
}

.navbar-default .navbar-nav>li>a:focus, .navbar-default .navbar-nav>li>a:hover {
    color: #cc51e1;
    background-color: transparent;
}*/

  </style>


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/autodial') }}">
                        OTP

                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else




                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

</body>
</html>
