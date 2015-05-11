@extends('app')

{{-- Web site Title --}}
@section('title')
{{ trans('kotoba::general.information') }} :: @parent
@stop

@section('styles')
	<!-- Owl carousel css -->
{{--
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl-carousel/owl.carousel.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/rs-plugin/css/settings.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/rs-plugin/css/extralayers.css') }}">

	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/blue.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
--}}
@stop

@section('scripts')
{{--
	<!-- jQuery REVOLUTION Slider  -->
	<script type="text/javascript" src="{{ asset('assets/vendors/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/vendors/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>

	<!-- Owl carousel javascript -->
	<script type="text/javascript" src="{{ asset('assets/vendors/owl-carousel/owl.carousel.js') }}"></script>
	<!-- Initialization of Plugins -->
	<script type="text/javascript" src="{{ asset('assets/js/template.js') }}"></script>
	<!-- Custom Scripts -->
	<script type="text/javascript" src="{{ asset('assets/js/custom.js') }}"></script>
--}}
@stop

@section('inline-scripts')
$(document).ready(function(){
	$('.carousel').carousel();
});
@stop


{{-- Content --}}
@section('content')




<div id="carousel-banner" class="carousel slide" data-ride="carousel">
<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#carousel-banner" data-slide-to="0" class="active"></li>
		<li data-target="#carousel-banner" data-slide-to="1"></li>
		<li data-target="#carousel-banner" data-slide-to="2"></li>
	</ol>
<!-- Wrapper for slides -->
<div class="carousel-inner" role="listbox">
	<div class="item active">
		<img src="{{ asset('images/theme/arkansas.png') }}" alt="...">
		<div class="carousel-caption">
			<h1>
			The LARGEST Game Store in Arkansas
			</h1>
		</div>
	</div>

	<div class="item">
		<img src="{{ asset('images/theme/board_game.jpg') }}" alt="...">
		<div class="carousel-caption">
			<h2>
			30,000 Square Feet.
			<br>
			Huge selection of Comics, Board Games, Card Games, and Lots more.
			<br>
			Come check us out.
			</h2>
		</div>
	</div>

	<div class="item">
		<img src="{{ asset('images/theme/card_games.jpg') }}" alt="...">
		<div class="carousel-caption">
			<h2>
			30,000 Square Feet.
			<br>
			Huge selection of Comics, Board Games, Card Games, and Lots more.
			<br>
			Come check us out.
			</h2>
		</div>
	</div>
</div>

<!-- Controls -->
	<a class="left carousel-control" href="#carousel-banner" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#carousel-banner" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>

</div>



<div class="row">
	<div class="col-md-12">
		<h1 class="text-center title">Features</h1>
		<div class="separator"></div>
		<p class="text-center">This is what we do.  And we do it well.</p>
		<div class="row grid-space-10">
			<div class="col-sm-4">
				<div class="box-style-2">
					<div class="icon-container default-bg">
						<i class="fa fa-leaf"></i>
					</div>
					<div class="body">
						<h2>Collectible Card Games</h2>
						<p>Voluptatem ad provident non veritatis beatae cupiditate amet reiciendis.</p>
{{--
						<a href="page-services.html" class="link"><span>Read More</span></a>
--}}
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box-style-2">
					<div class="icon-container default-bg">
						<i class="fa fa-rebel"></i>
					</div>
					<div class="body">
						<h2>Board Games</h2>
						<p>Iure sequi unde hic. Sapiente quaerat labore inventore veritatis cumque.</p>
{{--
						<a href="page-services.html" class="link"><span>Read More</span></a>
--}}
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box-style-2">
					<div class="icon-container default-bg">
						<i class="fa fa-leanpub"></i>
					</div>
					<div class="body">
						<h2>Comic Books</h2>
						<p>Inventore dolores aut laboriosam cum consequuntur delectus sequi! Eum est.</p>
{{--
						<a href="page-services.html" class="link"><span>Read More</span></a>
--}}
					</div>
				</div>
			</div>
		</div>
		<div class="row grid-space-10">
			<div class="col-sm-4">
				<div class="box-style-2">
					<div class="icon-container default-bg">
						<i class="fa fa-rocket"></i>
					</div>
					<div class="body">
						<h2>Vintage Video Games</h2>
						<p>Voluptatem ad provident non veritatis beatae cupiditate amet reiciendis.</p>
{{--
						<a href="page-services.html" class="link"><span>Read More</span></a>
--}}
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box-style-2">
					<div class="icon-container default-bg">
						<i class="fa fa-connectdevelop"></i>
					</div>
					<div class="body">
						<h2>Dice and Role Playing Games</h2>
						<p>Iure sequi unde hic. Sapiente quaerat labore inventore veritatis cumque.</p>
{{--
						<a href="page-services.html" class="link"><span>Read More</span></a>
--}}
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box-style-2">
					<div class="icon-container default-bg">
						<i class="fa fa-bullhorn"></i>
					</div>
					<div class="body">
						<h2>Other Stuff</h2>
						<p>Inventore dolores aut laboriosam cum consequuntur delectus sequi! Eum est.</p>
{{--
						<a href="page-services.html" class="link"><span>Read More</span></a>
--}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




@stop
