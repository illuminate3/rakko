<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Rakko - Installation - Set Standard App Settings</title>

<!-- Font -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-3.3.2/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/font-awesome-4.3.0/css/font-awesome.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/installer/css/installer.css') }}">

<!--  JS -->
	<script type="text/javascript" src="{{ asset('assets/vendors/jquery/jquery-2.1.3.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-3.3.2/js/bootstrap.min.js') }}"></script>

</head>
<body>
<section>

<div class="container-fluid">
<div class="row centered">

	<div class="col-sm-5 col-sm-offset-2">

		<div class="panel panel-default">
			<div class="panel-heading title_panel">
				{{ trans('installer::install.install_settings') }}
			</div><!-- ./panel-heading -->
			<div class="panel-body body_panel">

				<ul>

					<li class="plain">
					@if ( $config_installed === true )
						<span class="glyphicon glyphicon-ok text-success"></span>
						{{ trans('installer::install.success.installed') }}
					@else
						<span class="glyphicon glyphicon-wrench text-danger"></span>
						{{ trans('installer::install.command.change_installed') }}
					@endif
					</li>

					<li class="plain">
						<span class="glyphicon glyphicon-wrench text-danger"></span>
						{{ $config_timezone }}
						{{ trans('installer::install.ask.timezone') }}
					</li>

				</ul>

					@if ( $config_installed === false )
						<div class="row">
							<div class="col-sm-8 col-sm-offset-2 hide" id="button">
								<input type="submit" class="btn btn-success btn-block" onClick="location.reload(true)" value="{{ trans('installer::install.button.retry') }}"/>
							</div>
						</div>
					@else
						<div class="row">
							<div class="col-sm-8 col-sm-offset-2 hide" id="button">
								<a href="{{url('install/final')}}" class="btn btn-success btn-block" title="{{ trans('installer::install.button.next') }}">
									<i class="fa fa-play fa-fw"></i>
									{{ trans('installer::install.button.next') }}
								</a>
							</div>
						</div>
					@endif

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
