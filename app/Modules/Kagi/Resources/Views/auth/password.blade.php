@extends('app')

@section('content')
<div class="container-fluid">
<div class="row">

	<div class="col-md-8 col-md-offset-2">

		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans('kotoba::auth.reset_password') }}
			</div>
			<div class="panel-body">

				@if (session('status'))
					<div class="alert alert-success">
						{{ session('status') }}
					</div>
				@endif

				@if (count($errors) > 0)
					@include('kagi::_partials.errors')
				@endif

				<form class="form-horizontal" role="form" method="POST" action="/password/email">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group">
						<label class="col-md-4 control-label">{{ trans('kotoba::account.email') }}</label>
						<div class="col-md-6">
							<input type="email" class="form-control" name="email" value="{{ old('email') }}">
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-primary">
								{{ trans('kotoba::auth.button.send_pass_link') }}
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
