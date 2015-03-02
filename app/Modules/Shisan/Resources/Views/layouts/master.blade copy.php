<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>
		@section('title')
			{{ Config::get('vedette.vedette_html.title') }}
		@show
	</title>
	<meta name="author" content="{{ Config::get('vedette.vedette_html.author') }}" />
	<meta name="keywords" content="{{ Config::get('vedette.vedette_html.keywords') }}" />
	<meta name="description" content="{{ Config::get('vedette.vedette_html.description') }}" />

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="{{ asset('assets/ico/favicon.png') }}">
	<link rel="icon" href="{{ asset('assets/favicon.ico') }}">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}">
{{--
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}">
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}">
--}}

<!-- ------------------------------------------ Google Fonts ------------------------------------------ -->
{{--
	<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>
--}}

<!-- ------------------------------------------ CSS stylesheets ------------------------------------------ -->
{{-- Bootstrap::cssBoot() --}}
{{-- Bootstrap::cssFont() --}}

	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-3.3.2/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-3.3.2/css/bootstrap-theme.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/font-awesome-4.3.0/css/font-awesome.css') }}">

	<link rel="stylesheet" type="text/css" href="{{ asset('css/SlidePushMenus.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/navgoco/jquery.navgoco.css') }}" media="screen" />

	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">

<!-- ------------------------------------------ app loaded CSS stylesheets ------------------------------------------ -->
	@yield('styles')

<!-- ------------------------------------------ head loaded js ------------------------------------------ -->
	<script type="text/javascript" src="{{ asset('assets/vendors/jquery/modernizr-2.6.2-respond-1.1.0.min.js') }}"></script>
{{--
	<script type="text/javascript" src="{{ asset('assets/DataTables/media/js/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
--}}
</head>

<body>

	@include('layouts.navigation')

	@include('layouts._partials.side_navigation')

	@include('layouts._partials.left_side')
	@include('layouts._partials.right_side')

	<div id="wrap" class="container-fluid">
		@include('layouts.content')
	</div>
	<!-- ./container -->

	@include('layouts.footer')

</body>

<!-- ------------------------------------------ js ------------------------------------------ -->
{{-- Bootstrap::js2x() --}}
	<script>window.jQuery || document.write('<script type="text/javascript" src="assets/vendors/jquery/jquery-2.1.3.min.js"><\/script>')</script>
	<script type="text/javascript"  src="{{ asset('assets/vendors/bootstrap-3.3.2/js/bootstrap.min.js') }}"></script>

	<script type="text/javascript"  src="{{ asset('assets/vendors/navgoco/jquery.cookie.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/vendors/navgoco/jquery.navgoco.min.js') }}"></script>
	<script type="text/javascript"  src="{{ asset('js/SlidePushMenus.js') }}"></script>

	<script type="text/javascript"  src="{{ asset('js/main.js') }}"></script>

<!-- ------------------------------------------ head loaded js ------------------------------------------ -->
	@yield('scripts')

<!-- ------------------------------------------ app loaded js ------------------------------------------ -->
	<script>
$(function () {

	var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
		menuRight = document.getElementById( 'cbp-spmenu-s2' ),
		showLeft = document.getElementById( 'showLeft' ),
		showRight = document.getElementById( 'showRight' ),
		body = document.body;

menuLeft.onclick = function () {
	classie.toggle( this, 'active' );
	classie.toggle( menuLeft, 'cbp-spmenu-open' );
};
menuRight.onclick = function () {
	classie.toggle( this, 'active' );
	classie.toggle( menuRight, 'cbp-spmenu-open' );
};


	showLeft.onclick = function() {
		classie.toggle( this, 'active' );
		classie.toggle( menuLeft, 'cbp-spmenu-open' );
		disableOther( 'showLeft' );
	};
	showRight.onclick = function() {
		classie.toggle( this, 'active' );
		classie.toggle( menuRight, 'cbp-spmenu-open' );
		disableOther( 'showRight' );
	};

	function disableOther( button ) {
		if( button !== 'showLeft' ) {
			classie.toggle( showLeft, 'disabled' );
		}
		if( button !== 'showRight' ) {
			classie.toggle( showRight, 'disabled' );
		}
	}

});
$(document).ready(function() {
	// Initialize navgoco with default options
	$("#navagoco").navgoco({
		caretHtml: '',
		accordion: false,
		openClass: 'open',
		save: true,
		cookie: {
			name: 'navgoco',
			expires: false,
			path: '/'
		},
		slide: {
			duration: 400,
			easing: 'swing'
		},
		// Add Active class to clicked menu item
		onClickAfter: function(e, submenu) {
//			e.preventDefault();
			$('#navagoco').find('li').removeClass('active');
			var li =  $(this).parent();
			var lis = li.parents('li');
			li.addClass('active');
			lis.addClass('active');
		},
	});

	$("#collapseAll").click(function(e) {
		e.preventDefault();
		$("#navagoco").navgoco('toggle', false);
	});

	$("#expandAll").click(function(e) {
		e.preventDefault();
		$("#navagoco").navgoco('toggle', true);
	});
});
		@yield('inline-scripts')
	</script>

</html>
