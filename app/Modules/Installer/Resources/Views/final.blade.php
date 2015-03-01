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
	<link rel="stylesheet" type="text/css" href="{{ asset('installer/css/auth/style.css') }}">

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
				{{ trans('installer::install.settings') }}
			</div><!-- ./panel-heading -->
			<div class="panel-body">



    <div class="row-fluid">
      <div class="span12">
        <div class="span12 reset_title">Done</div>
        <div class="reset_form installtzform">
            <div class="row-fluid">
            <div class="reset_text donetext">That's it. All settings have been saved. Good to go !<br/>Please login with your username and password.</div>

              <div class="submit_button_main">
              <a href="{{url('login')}}"> Login </a>
            </div>




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

</body>
</html>
