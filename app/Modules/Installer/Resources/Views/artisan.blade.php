<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Rakko - Installation - Check Application Requirements</title>

<!-- Font -->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-3.3.2/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/font-awesome-4.3.0/css/font-awesome.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('installer/css/auth/style.css') }}">

<!--  JS -->
	<script type="text/javascript" src="{{ asset('assets/vendors/jquery/jquery-2.1.3.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-3.3.2/js/bootstrap.min.js') }}"></script>

</head>
<body>
<section>

<div class="container-fluid">
<div class="row centered">

	<div class="col-sm-4 col-sm-offset-4">

		<div class="panel panel-default">
			<div class="panel-heading title_panel">
				{{ trans('installer::install.install_check') }}
			</div><!-- ./panel-heading -->
			<div class="panel-body">

				<div class="row">
				<div class="col-sm-8 col-sm-offset-2">

					<ul>

						<li>
						@if ( $flag1 === true )
							<span class="glyphicon glyphicon-ok text-success"></span>
							{{ trans('installer::install.success.migrate') }}
						@else
							<span class="glyphicon glyphicon-remove text-danger"></span>
							{{ trans('installer::install.error.migrate') }}
						@endif
						</li>

						<li>
						@if ( $flag2 === true )
							<span class="glyphicon glyphicon-ok text-success"></span>
							{{ trans('installer::install.success.seed') }}
						@else
							<span class="glyphicon glyphicon-remove text-danger"></span>
							{{ trans('installer::install.error.seed') }}
						@endif
						</li>

						@if ( ($flag1 === false) || ($flag2 === false) )
							<div class="row">
								<div class="col-sm-8 col-sm-offset-2 hide" id="button">
									{{ trans('installer::install.error.db_seed') }}
								</div>
							</div>
						@else
							<div class="row">
								<div class="col-sm-8 col-sm-offset-2 hide" id="button">
									<a href="{{url('install/database')}}" class="btn btn-success btn-block" title="{{ trans('installer::button.next') }}">
										<i class="fa fa-play fa-fw"></i>
										{{ trans('installer::button.next') }}
									</a>
								</div>
							</div>
						@endif

					</ul>

				</div><!-- ./col -->
				</div><!-- ./row -->

			</div><!-- ./panel-body -->
		</div><!-- ./panel -->

	</div><!-- ./col -->

</div><!-- ./row -->

<footer class="footer">
	<div class="container-fluid">
		<p class="text-muted">
			<hr>
			{{ Config::get('general.footer') }}
		</p>
	</div>
</footer>
</div><!-- ./container-fluid -->

</section>

<script>
$(document).ready(function() {
	fade_in_next();
});
var i = 0;
function fade_in_next()
{
	$("ul li:hidden:first").fadeIn("slow", function()
	{
		i=i+1;
		var result = setTimeout(fade_in_next, 500);
		if(i==8) {
			$('#button').removeClass('hide');
		}
	});
}
</script>
</body>
</html>
