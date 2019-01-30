<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="{{ asset('favicon.ico')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Gaelle Hardy') }}</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- extra style     -->
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('css/animate.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('css/light-bootstrap-dashboard.css?v=1.4.0')}}" rel="stylesheet"/>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/pe-icon-7-stroke.css')}}" rel="stylesheet" />
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> --}}


</head>
<body>
    <div id="app">
        <div class="wrapper">
            <div class="sidebar" data-color="azure" data-image="{{ asset('storage/dashboard/sidebar-5.jpg')}}">
            <!--
                Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
                Tip 2: you can also add an image using data-image tag
            -->
                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="{{ route('dashboard')}}" class="simple-text">
                            {{Auth::user()->first_name}} {{Auth::user()->name}}
                        </a>
                    </div>

                    @yield('sidebar')

                </div>
            </div>
        
            <div class="main-panel">
                <nav class="navbar navbar-default navbar-fixed">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="{{ route('dashboard')}}">Dashboard</a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-left">
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-dashboard"></i>
                                    </a>
                                </li>
                            </ul>
        
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="">
                                        Account
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                        <p>Log out</p>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                @yield('content')
        
                <footer class="footer">
                    <div class="container-fluid">
                        <nav class="pull-left">
                            <ul>
                                <li>
                                    <a href="#">
                                        Home
                                    </a>
                                </li>
        
                            </ul>
                        </nav>
                        <p class="copyright pull-right">
                            &copy; <script>document.write(new Date().getFullYear())</script> <a href="#">Gaëlle Hardy</a>, made with love for a better web
                        </p>
                    </div>
                </footer>
        
            </div>
        </div>
    </div>     
</body>
    <script src="{{ asset('js/app.js') }}"></script>
    <!--   extra javascript   -->
    <script src="{{ asset('js/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/chartist.min.js')}}"></script>        
    <script src="{{ asset('js/bootstrap-notify.js')}}"></script>
    {{-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> --}}
    <script src="{{ asset('js/light-bootstrap-dashboard.js?v=1.4.0')}}"></script>
    <script src="{{ asset('js/demo.js')}}"></script>
</html>
        