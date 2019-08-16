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

	<title>Job Hunt</title>

	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap-grid.css" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.css" />
  <link rel="stylesheet" href="css/apps/fonts/maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="css/colors/colors.css" />
	<link rel="stylesheet" href="css/apps/icons.css">
	<link rel="stylesheet" href="css/apps/animate.min.css">
	<link rel="stylesheet" type="text/css" href="css/apps/style.css" />
	<link rel="stylesheet" type="text/css" href="css/apps/responsive.css" />
	<link rel="stylesheet" type="text/css" href="css/apps/chosen.css" />
  <!-- STyles -->

</head>
<body>

<div class="theme-layout" id="scrollup">
	<!--header-->
	@include('layouts.inc.header')
	<!--content-->
	@yield('content')
	<!--footer-->	
	@include('layouts.inc.footer')
</div>

<script src="js/jquery/jquery.min.js" type="text/javascript"></script>
<script src="js/jquery/counter.js" type="text/javascript"></script>
<script src="js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
<script src="js/bootstrap/mouse.js" type="text/javascript"></script>
<script data-cfasync="false" src="js/apps/email-decode.min.js"></script>
<script src="js/apps/modernizr.js" type="text/javascript"></script>
<script src="js/apps/script.js" type="text/javascript"></script>
<script src="js/apps/wow.min.js" type="text/javascript"></script>
<script src="js/apps/slick.min.js" type="text/javascript"></script>
<script src="js/apps/parallax.js" type="text/javascript"></script>
<script src="js/apps/select-chosen.js" type="text/javascript"></script>

</body>
</html>
