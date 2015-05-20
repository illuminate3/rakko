@extends('app')

@section('content')
<div class="row">
<div class="col-md-4 col-md-offset-4">


<div role="tabpanel">

	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#social" aria-controls="social" role="tab" data-toggle="tab">{{ trans('kotoba::button.social_log_in') }}</a></li>
		<li role="presentation"><a href="/password/email" aria-controls="forgot_password" role="tab">{{ trans('kotoba::button.forgot_password') }}</a></li>
		<li role="presentation"><a href="/auth/register" aria-controls="register" role="tab">{{ trans('kotoba::button.register') }}</a></li>
		<li role="presentation"><a href="#login" aria-controls="login" role="tab" data-toggle="tab">{{ trans('kotoba::button.admin') }}</a></li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="social">

			<div class="form-group margin-top-xl">
				<a href="/social/login" class="btn btn-success btn-block">{{ trans('kotoba::button.log_in') }}</a>
			</div>

		</div>
		<div role="tabpanel" class="tab-pane" id="login">

				<form class="form-horizontal margin-top-xl" role="form" method="POST" action="/auth/login">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group">
						<label class="col-md-3 control-label">{{ trans('kotoba::account.email') }}</label>
						<div class="col-md-9">
							<input type="email" class="form-control" name="email" value="{{ old('email') }}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">{{ trans('kotoba::auth.password') }}</label>
						<div class="col-md-9">
							<input type="password" class="form-control" name="password">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-9">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="remember"> {{ trans('kotoba::auth.remember_me') }}
								</label>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-9">
							<button type="submit" class="btn btn-success btn-block">
								{{ trans('kotoba::button.log_in') }}
							</button>
						</div>
					</div>

				</form>

		</div>
	</div>

</div>


</div><!-- ./col -->
</div><!-- ./row -->
@endsection
