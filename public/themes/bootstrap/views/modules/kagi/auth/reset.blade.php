@extends('app')

@section('content')
<div class="row">

		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('kotoba::auth.reset_password') }}</div>
				<div class="panel-body">

				@if (count($errors) > 0)
					@include('kagi::_partials.errors')
				@endif

					<form class="form-horizontal" role="form" method="POST" action="/password/reset">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="token" value="{{ $token }}">

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
							<label class="col-md-4 control-label">{{ trans('kotoba::auth.password_confirmation') }}</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									{{ trans('kotoba::auth.button.reset_password') }}
								</button>
							</div>
						</div>

				</form>

			</div><!-- ./panel-body -->
		</div><!-- ./panel -->

	</div><!-- ./col -->

</div><!-- ./row -->
@endsection
