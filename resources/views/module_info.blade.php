<!DOCTYPE html>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="author" content="{{ Config::get('general.author') }}" />
	<meta name="keywords" content="{{ Config::get('general.keywords') }}" />
	<meta name="description" content="{{ Config::get('general.description') }}" />

	<title>
		@section('title')
			{{ Config::get('general.title') }}
		@show
	</title>

	<link rel="shortcut icon" href="{{ asset('ico/favicon.png') }}">
	<link rel="icon" href="{{ asset('favicon.ico') }}">
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('ico/apple-touch-icon-57-precomposed.png') }}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('ico/apple-touch-icon-72-precomposed.png') }}">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('ico/apple-touch-icon-144-precomposed.png') }}">

<!-- ------------------------------------------ Google Fonts ------------------------------------------ -->
<!--
	<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>
-->

<!-- ------------------------------------------ CSS stylesheets ------------------------------------------ -->

	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-3.3.2/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/font-awesome-4.3.0/css/font-awesome.css') }}">

</head>

<body>


	@include('_partials.navigation')

	<div class="container-fluid">
<!-- <div id="wrap" class="container"> -->
		@yield('content')
	</div><!-- ./container -->

	@include('_partials.footer')

</body>
</html>
