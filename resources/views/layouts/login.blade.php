<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../public/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Gaelle Hardy') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- extra styles -->
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../public/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../public/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css')}}">
</head>
<body>
    <div id="app">

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- extra scripts -->
    <script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="../vendor/animsition/js/animsition.min.js"></script>
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../vendor/select2/select2.min.js"></script>
	<script src="../vendor/countdowntime/countdowntime.js"></script>
	<script src="{{ asset('js/main.js')}}"></script>
</body>
</html>