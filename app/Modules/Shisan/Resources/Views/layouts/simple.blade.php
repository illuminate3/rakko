<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>
		@section('title')
			{{ Config::get('vedette.vedette_html.title') }}
		@show
	</title>
	<meta name="author" content="{{ Config::get('vedette.vedette_html.author') }}" />
	<meta name="keywords" content="{{ Config::get('vedette.vedette_html.keywords') }}" />
	<meta name="description" content="{{ Config::get('vedette.vedette_html.description') }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}">
	<link rel="apple-touch-icon-precomposed" href="{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}">
	<link rel="shortcut icon" href="{{ asset('assets/ico/favicon.png') }}">
	<link rel="icon" href="../../favicon.ico">
	{{ Bootstrap::cssBoot() }}
	{{ Bootstrap::cssFont() }}
	<link rel="stylesheet" type="text/css" href="{{ asset('packages/illuminate3/vedette/assets/css/vedette.css') }}">
	<!-- Google Fonts -->
<!--
	<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300' rel='stylesheet' type='text/css'>
-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>
	@yield('styles')
</head>

<body class="backcolor">

	<div id="wrap" class="container"><!-- Container -->

		<!-- Notifications -->
		{{-- include('layouts.partials.notifications') --}}
		<!-- ./ notifications -->

		@yield('content')

	</div><!-- ./ container -->

</body>

	{{ Bootstrap::js2x() }}
	@yield('scripts')
	<script>
		@yield('inline-scripts')
	</script>

</html>
