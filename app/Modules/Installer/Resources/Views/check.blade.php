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
				{{ trans('installer::install.install_check') }}
			</div><!-- ./panel-heading -->
			<div class="panel-body">

				<div class="row">
				<div class="col-sm-8 col-sm-offset-2">

					<?php $flag = true; ?>
					<ul>

						<li>
						@if ( version_compare(phpversion(),"5.5",">=") )
							<span class="glyphicon glyphicon-ok text-success"></span>
							{{ trans('installer::install.success.php_version') }}
						@else
							<?php $flag = false; ?>
							<span class="glyphicon glyphicon-remove text-danger"></span>
							{{ trans('installer::install.error.php_version') }}
						@endif
						</li>

						<li>
						@if ( extension_loaded('pdo') )
							<span class="glyphicon glyphicon-ok text-success"></span>
							{{ trans('installer::install.success.pdo') }}
						@else
							<?php $flag = false; ?>
							<span class="glyphicon glyphicon-remove text-danger"></span>
							{{ trans('installer::install.error.pdo') }}
						@endif
						</li>

						<li>
						@if ( extension_loaded('mcrypt') )
							<span class="glyphicon glyphicon-ok text-success"></span>
							{{ trans('installer::install.success.mcrypt') }}
						@else
							<?php $flag = false; ?>
							<span class="glyphicon glyphicon-remove text-danger"></span>
							{{ trans('installer::install.error.mcrypt') }}
						@endif
						</li>

						<li>
						@if ( extension_loaded('gd') )
							<span class="glyphicon glyphicon-ok text-success"></span>
							{{ trans('installer::install.success.gd') }}
						@else
							<?php $flag = false; ?>
							<span class="glyphicon glyphicon-remove text-danger"></span>
							{{ trans('installer::install.error.gd') }}
						@endif
						</li>

						<li>
						@if ( is_writable(public_path().'/images') )
							<span class="glyphicon glyphicon-ok text-success"></span>
							{{ trans('installer::install.success.image') }}
						@else
							<?php $flag = false; ?>
							<span class="glyphicon glyphicon-remove text-danger"></span>
							{{ trans('installer::install.error.image') }}
						@endif
						</li>

						<li>
						@if ( is_writable(storage_path().'/logs') )
							<span class="glyphicon glyphicon-ok text-success"></span>
							{{ trans('installer::install.success.storage') }}
						@else
							<?php $flag = false; ?>
							<span class="glyphicon glyphicon-remove text-danger"></span>
							{{ trans('installer::install.error.storage') }}
						@endif
						</li>

						@if ( $flag === false )
							<div class="row">
								<div class="col-sm-8 col-sm-offset-2 hide" id="button">
									<input type="submit" class="btn btn-success btn-block" onClick="location.reload(true)" value="{{ trans('installer::install.button.retry') }}"/>
								</div>
							</div>
						@else
							<li>
								<h4>
									{{ trans('installer::install.please_wait') }}
								</h4>
							</li>
							<div class="row">
								<div class="col-sm-8 col-sm-offset-2 hide" id="button">
									<a href="{{url('install/artisan')}}" class="btn btn-success btn-block" title="{{ trans('installer::install.button.next') }}">
										<i class="fa fa-play fa-fw"></i>
										{{ trans('installer::install.button.next') }}
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
