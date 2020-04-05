<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="CreativeLayers">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- CSRF Token -->

	<title>@yield('title', '')</title>

	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="{{URL::asset('css/bootstrap/bootstrap-grid.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{URL::asset('css/bootstrap/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('css/apps/fonts/maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{URL::asset('css/colors/colors.css')}}" />
	<link rel="stylesheet" href="{{URL::asset('css/apps/icons.css')}}">
	<link rel="stylesheet" href="{{URL::asset('css/apps/animate.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('css/apps/style11.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{URL::asset('css/apps/responsives.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{URL::asset('css/apps/chosen.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{URL::asset('css/apps/logo2.css')}}" />
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkwr5rmzY9btU08sQlU9N0qfmo8YmE91Y&callback=loadMap"></script>
  <!-- STyles -->

	<!--Jquery-->
	<script src="{{URL::asset('js/jquery/jquery.min.js')}}" type="text/javascript"></script>

</head>
<body>
	<div class="page-loading">
		<img src="{{URL::asset('images/loaders.gif')}}" alt="" />
	</div>
	<div class="theme-layout" id="scrollup">
		<!--header-->
		@include('layouts.inc.header')
		<!--content-->
		@yield('content')
		<!--footer-->
		@include('layouts.inc.footer')
	</div>


	<script src="{{URL::asset('js/jquery/counter.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('js/bootstrap/bootstrap.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('')}}js/bootstrap/mouse.js" type="text/javascript"></script>
	<script data-cfasync="false" src="{{URL::asset('js/apps/email-decode.min.js')}}"></script>
	<script src="{{URL::asset('js/apps/modernizr.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('js/apps/script.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('js/apps/wow.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('js/apps/slick.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('js/apps/parallax.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('js/apps/select-chosen.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('js/apps/tag.js')}}" type="text/javascript"></script>
</body>
</html>
