@extends('app')

@section('content')
<div class="row">

	<div class="col-md-8 col-md-offset-2">

		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans('kotoba::auth.confirmation') }}
			</div>
			<div class="panel-body">

				{!! Form::open([
					'url' => ['auth/confirm', $code],
					'method' => 'POST',
					'class' => 'form'
				]) !!}

					<div class="form-group">
						<label class="col-md-4 control-label">{{ trans('kotoba::account.email') }}</label>
						<div class="col-md-6">
							<input type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>
						</div>
					</div>

<br>
<br>
<br>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-success btn-block">
								{{ trans('kotoba::button.register') }}
							</button>
						</div>
					</div>

				{!! Form::close() !!}

			</div><!-- ./panel-body -->
		</div><!-- ./panel -->

	</div><!-- ./col -->

</div><!-- ./row -->
@endsection
