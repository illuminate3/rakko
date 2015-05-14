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

<!--
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-3.3.2/css/bootstrap-theme.min.css') }}">
-->

	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/illuminate3/css/standard.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/SlidePushMenus.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/navgoco/jquery.navgoco.css') }}" media="screen" />

<!-- ------------------------------------------ app loaded CSS stylesheets ------------------------------------------ -->
	@yield('styles')

<!-- ------------------------------------------ head loaded js ------------------------------------------ -->
	<script type="text/javascript" src="{{ asset('assets/vendors/jquery/modernizr-2.6.2-respond-1.1.0.min.js') }}"></script>
<!--
	<script type="text/javascript" src="{{ asset('assets/vendors/DataTables/media/js/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/vendors/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/vendors/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
-->
</head>

<body>

{{-- dd('die') --}}

	@include('_partials.navigation')
	@include('_partials.left_side')
	@include('_partials.right_side')

	<div class="container-fluid">
<!-- <div id="wrap" class="container"> -->
		@include('_partials.content')
	</div><!-- ./container -->

	@include('_partials.footer')


<!-- ------------------------------------------ js ------------------------------------------ -->

	<script type="text/javascript" src="{{ asset('assets/vendors/jquery/jquery-2.1.3.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-3.3.2/js/bootstrap.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('assets/js/SlidePushMenus.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/vendors/navgoco/jquery.cookie.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/vendors/navgoco/jquery.navgoco.min.js') }}"></script>

<!--
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>
-->


<!-- ------------------------------------------ app loaded js ------------------------------------------ -->
	@yield('scripts')

<!-- ------------------------------------------ template loaded js ------------------------------------------ -->
	<script type="text/javascript">
		@yield('inline-scripts')
	</script>
	<script type="text/javascript">
		$(function () {

			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
//				menuRight = document.getElementById( 'cbp-spmenu-s2' ),
				showLeft = document.getElementById( 'showLeft' ),
//				showRight = document.getElementById( 'showRight' ),
				body = document.body;

				menuLeft.onclick = function () {
					classie.toggle( this, 'active' );
					classie.toggle( menuLeft, 'cbp-spmenu-open' );
				};
// 				menuRight.onclick = function () {
// 					classie.toggle( this, 'active' );
// 					classie.toggle( menuRight, 'cbp-spmenu-open' );
// 				};

			showLeft.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeft' );
			};
// 			showRight.onclick = function() {
// 				classie.toggle( this, 'active' );
// 				classie.toggle( menuRight, 'cbp-spmenu-open' );
// 				disableOther( 'showRight' );
// 			};

			function disableOther( button ) {
				if( button !== 'showLeft' ) {
					classie.toggle( showLeft, 'disabled' );
				}
				if( button !== 'showRight' ) {
//					classie.toggle( showRight, 'disabled' );
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
	</script>

</body>
</html>
