@extends('app')

@section('content')
<div class="row">
<div class="col-md-4 col-md-offset-4">


<div role="tabpanel">

	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation"><a href="#social" aria-controls="social" role="tab" data-toggle="tab">{{ trans('kotoba::button.log_in') }}</a></li>
		<li role="presentation"><a href="/password/email" aria-controls="forgot_password" role="tab">{{ trans('kotoba::button.forgot_password') }}</a></li>
		<li role="presentation" class="active"><a href="#register" aria-controls="register" role="tab" data-toggle="tab">{{ trans('kotoba::button.register') }}</a></li>
		<li role="presentation"><a href="/auth/login" aria-controls="login">{{ trans('kotoba::button.admin') }}</a></li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane" id="social">

			<div class="form-group margin-top-xl">
				<a href="/social/login" class="btn btn-success btn-block">{{ trans('kotoba::button.log_in') }}</a>
			</div>

		</div>
		<div role="tabpanel" class="tab-pane active" id="register">

				<form class="form-horizontal margin-top-xl" role="form" method="POST" action="/auth/register">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-3 control-label">{{ trans('kotoba::account.name') }}</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

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
							<label class="col-md-3 control-label">{{ trans('kotoba::auth.password_confirmation') }}</label>
							<div class="col-md-9">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-9">
							<button type="submit" class="btn btn-primary btn-block">
								{{ trans('kotoba::button.register') }}
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



@section('content')
<div class="container-fluid">
<div class="row">

		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('kotoba::auth.register') }}</div>
				<div class="panel-body">

				@if (count($errors) > 0)
					@include('kagi::_partials.errors')
				@endif

					<form class="form-horizontal" role="form" method="POST" action="/auth/register">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('kotoba::account.name') }}</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

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
									{{ trans('kotoba::button.register') }}
								</button>
							</div>
						</div>

				</form>

			</div><!-- ./panel-body -->
		</div><!-- ./panel -->

	</div><!-- ./col -->

</div><!-- ./row -->
</div><!-- ./container-fluid -->
@endsection
