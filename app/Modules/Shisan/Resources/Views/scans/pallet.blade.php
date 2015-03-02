@extends(Config::get('vedette.vedette_views.layout'))

@section('title')
@parent
	{{ Config::get('vedette.vedette_html.separator') }}
: Choose Pallet
@stop

@section('scripts')
@stop

@section('styles')
@stop

@section('inline-scripts')
@stop


@section('content')

<h1>
{{--
	<p class="pull-right">
		<a href="{{{ URL::to('scans/index') }}}" class="btn btn-primary btn-block">Scans</a>
	</p>
--}}
		Scan Pallet
	<hr>
</h1>


{{ Form::open(array('route' => 'scans.pallet')) }}

	<div class="row">
		<div class="col-sm-12">
		{{ Bootstrap::text(
			'barcode',
			null,
			Input::old('barcode'),
			$errors,
			'barcode fa-fw',
			[
				'id' => 'barcode',
				'placeholder' => 'Pallet BarCode',
				'autofocus',
				'' => 'onmouseover="this.focus();"'
			]
		) }}
		</div>
	</div>


	<div class="row">
		<div class="col-sm-4">
			{{ Bootstrap::submit(
				trans('lingos::button.enter'),
				[
					'class' => 'btn btn-success btn-block'
				]
			) }}
		</div>
		<div class="col-sm-4">
			{{ Bootstrap::linkIcon(
				'scans.index',
				trans('lingos::button.cancel'),
				'times fa-fw',
				[
					'class' => 'btn btn-default btn-block'
				]
			) }}
		</div>
		<div class="col-sm-4">
			{{ Bootstrap::linkIcon(
				'scans.index',
				'Return to Scans',
				'times fa-fw',
				[
					'class' => 'btn btn-primary btn-block'
				]
			) }}
		</div>
	</div>

{{ Form::close() }}
@stop
