@extends('app')

@section('content')
<div class="row">
<div class="col-md-4 col-md-offset-4">


<div role="tabpanel">

	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation"><a href="/auth/login" aria-controls="login">{{ trans('kotoba::auth.log_in') }}</a></li>
		<li role="presentation" class="active"><a href="#forgot_password" aria-controls="forgot_password" role="forgot_password" data-toggle="forgot_password">{{ trans('kotoba::auth.forgot_password') }}</a></li>
		<li role="presentation"><a href="/auth/register" aria-controls="register" role="tab">{{ trans('kotoba::button.register') }}</a></li>
		<li role="presentation"><a href="/social/login" aria-controls="social" role="tab">{{ trans('kotoba::button.social_log_in') }}</a></li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane" id="login">
		</div>
		<div role="tabpanel" class="tab-pane active" id="forgot_password">

				<form class="form-horizontal margin-top-xl" role="form" method="POST" action="/password/email">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group">
						<label class="col-md-2 control-label">{{ trans('kotoba::account.email') }}</label>
						<div class="col-md-10">
							<input type="email" class="form-control" name="email" value="{{ old('email') }}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2 control-label"></label>
						<div class="col-md-10">
							<button type="submit" class="btn btn-primary btn-block">
								{{ trans('kotoba::auth.button.send_pass_link') }}
							</button>
						</div>
					</div>

				</form>

		</div>
		<div role="tabpanel" class="tab-pane" id="register">
		</div>
		<div role="tabpanel" class="tab-pane" id="social">
		</div>
	</div>

</div>


</div><!-- ./col -->
</div><!-- ./row -->
@endsection
