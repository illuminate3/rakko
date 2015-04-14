@extends('app')

@section('content')
<div class="row">
<div class="col-md-4 col-md-offset-4">


<div role="tabpanel">

	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#login" aria-controls="login" role="tab" data-toggle="tab">{{ trans('kotoba::auth.log_in') }}</a></li>
		<li role="presentation"><a href="/password/email" aria-controls="forgot_password" role="tab">{{ trans('kotoba::auth.forgot_password') }}</a></li>
		<li role="presentation"><a href="/auth/register" aria-controls="register" role="tab">{{ trans('kotoba::button.register') }}</a></li>
		<li role="presentation"><a href="/social/login" aria-controls="social" role="tab">{{ trans('kotoba::button.social_log_in') }}</a></li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="login">

				<form class="form-horizontal margin-top-xl" role="form" method="POST" action="/auth/login">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group">
						<label class="col-md-2 control-label">{{ trans('kotoba::account.email') }}</label>
						<div class="col-md-10">
							<input type="email" class="form-control" name="email" value="{{ old('email') }}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2 control-label">{{ trans('kotoba::auth.password') }}</label>
						<div class="col-md-10">
							<input type="password" class="form-control" name="password">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2 control-label"></label>
						<div class="col-md-10">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="remember"> {{ trans('kotoba::auth.remember_me') }}
								</label>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2 control-label"></label>
						<div class="col-md-10">
							<button type="submit" class="btn btn-success btn-block">
								{{ trans('kotoba::button.log_in') }}
							</button>
						</div>
					</div>

				</form>

		</div>
		<div role="tabpanel" class="tab-pane" id="forgot_password">
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
