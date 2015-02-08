@extends('app')

@section('content')
<div class="container-fluid">
<div class="row">

	<div class="col-md-8 col-md-offset-2">

		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans('kotoba::auth.log_in') }}
			</div>
			<div class="panel-body">

				@if (count($errors) > 0)
					@include('kagi::_partials.errors')
				@endif

				<form class="form-horizontal" role="form" method="POST" action="/auth/login">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group">
						<label class="col-md-4 control-label">{{ trans('kotoba::account.email') }}</label>
						<div class="col-md-6">
							<input type="email" class="form-control" name="email" value="{{ old('email') }}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">{{ trans('kotoba::auth.password') }}</label>
						<div class="col-md-6">
							<input type="password" class="form-control" name="password">
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="remember"> {{ trans('kotoba::auth.remember_me') }}
								</label>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">

							<button type="submit" class="btn btn-success">
								{{ trans('kotoba::button.log_in') }}
							</button>

							<a href="/password/email" class="btn btn-info">
								{{ trans('kotoba::auth.forgot_password') }}
							</a>

							<a href="/auth/register" class="btn btn-primary">
								{{ trans('kotoba::button.register') }}
							</a>

							<a href="/social/login" class="btn btn-default">
								{{ trans('kotoba::button.social_log_in') }}
							</a>

						</div>
					</div>

				</form>

			</div><!-- ./panel-body -->
		</div><!-- ./panel -->

	</div><!-- ./col -->

</div><!-- ./row -->
</div><!-- ./container-fluid -->
@endsection
