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

<!--  3rd party -->
	<script type="text/javascript" src="{{ asset('installer/js/simplelogin/parsley.js') }}"></script>
	<link rel="stylesheet" type="text/css" href="{{ asset('installer/css/simplelogin/parsley.css') }}">

</head>
<body>
<section>


  <div class="content_detail">
    <div class="row-fluid">
      <div class="span12 reset_pass">
        <div class="logo"><img src="{{asset('assets/images/errorpages/logo12.png')}}" alt=""/></div>
        <div class="welcome_text2 syscheckhead">Installation</div>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <div class="span12 reset_title">Database Details</div>
        <div class="reset_form installdb">
          <div class="row-fluid">
          	<div class="reset_text">Please enter the Database Credentials</div>
            <div class="field_main">
              <form method="post" id="newpassform" name="newpassform" action="" data-validate="parsley">
              <div class="row-fluid field_data">
                <div class="span3 field_name">Host</div>
                <div class="span5">
                  <input type="text" id="host" name="host" class="span12 field_input" placeholder="host" data-required="true"  data-show-errors="true">
                </div>

              </div>
              <div class="row-fluid field_data">
                <div class="span3 field_name">Database</div>
                <div class="span5">
                  <input type="text" id="database" name="database" class="span12 field_input" placeholder="database" data-required="true"  data-show-errors="true">
                </div>

              </div>
               <div class="row-fluid field_data">
                <div class="span3 field_name">Username</div>
                <div class="span5">
                  <input type="text" id="username" name="username" class="span12 field_input" placeholder="username" data-required="true"  data-show-errors="true">
                </div>

              </div>
               <div class="row-fluid field_data">
                <div class="span3 field_name">Password</div>
                <div class="span5">
                  <input type="password" id="password" name="password" class="span12 field_input" placeholder="password" data-show-errors="true">
                </div>
              </div>

            </div>
            <div class="submit_button_main">
              <input type="submit" class="submit" value="Submit"/>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer">&copy; 2014 92five app </div>


</section>
</body>
</html>
