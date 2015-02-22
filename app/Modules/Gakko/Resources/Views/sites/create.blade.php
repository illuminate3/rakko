@extends(Config::get('vedette.vedette_views.layout'))

@section('title')
@parent
	{{ Config::get('vedette.vedette_html.separator') }}
	{{ trans('lingos::general.command.create') }}
@stop

@section('styles')
	<link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/css/datepicker3.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendors/chosen_v1.0.0/chosen.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendors/chosen_v1.0.0/chosen_bootstrap.css') }}">
@stop

@section('scripts')
	<script src="{{ asset('packages/illuminate3/vedette/assets/js/restfulizer.js') }}"></script>

	<script src="{{ asset('assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('assets/vendors/bootstrap-datepicker/js/datepicker-settings.js') }}"></script>
	<script src="{{ asset('assets/vendors/chosen_v1.0.0/chosen.jquery.min.js') }}"></script>
@stop

@section('inline-scripts')

	var text_confirm_message = '{{ trans('lingos::job_title.ask.delete') }}';

$(document).ready(function(){

	var config = {
		'.chosen-select'           : {},
		'.chosen-select-deselect'  : {allow_single_deselect:true},
		'.chosen-select-no-single' : {disable_search_threshold:10},
		'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
		'.chosen-select-width'     : {width:"95%"}
	}
	for (var selector in config) {
		$(selector).chosen(config[selector]);
	}

});
@stop

@section('content')
<div class="row">
<h1>
	<p class="pull-right">
	{{ Bootstrap::linkIcon(
		'sites.index',
		trans('lingos::button.back'),
		'chevron-left fa-fw',
		array('class' => 'btn btn-default')
	) }}
	</p>
	<i class="fa fa-edit fa-lg"></i>
	{{ trans('lingos::general.command.create') }}
	<hr>
</h1>
</div>


<div class="row">
{{ Form::open(
	[
		'route' => array('sites.store'),
		'subject' => 'form',
		'class' => 'form-horizontal',
		'files' => true
	]
) }}

	{{ Bootstrap::text(
		'name',
		null,
		Input::old('name'),
		$errors,
		'university fa-fw',
		[
			'id' => 'name',
			'placeholder' => trans('lingos::general.name'),
			'required',
			'autofocus',
			'tabindex' => '1'
		]
	) }}

	{{ Bootstrap::text(
		'address',
		null,
		Input::old('address'),
		$errors,
		'road fa-fw',
		[
			'id' => 'address',
			'placeholder' => trans('lingos::account.address'),
			'tabindex' => '2'
		]
	) }}

	{{ Bootstrap::text(
		'city',
		null,
		Input::old('name'),
		$errors,
		'home fa-fw',
		[
			'id' => 'city',
			'placeholder' => trans('lingos::account.city'),
			'tabindex' => '3'
		]
	) }}

	{{ Bootstrap::text(
		'state',
		null,
		Input::old('state'),
		$errors,
		'star fa-fw',
		[
			'id' => 'state',
			'placeholder' => trans('lingos::account.state'),
			'tabindex' => '4'
		]
	) }}

	{{ Bootstrap::text(
		'zipcode',
		null,
		Input::old('zipcode'),
		$errors,
		'paper-plane fa-fw',
		[
			'id' => 'zipcode',
			'placeholder' => trans('lingos::account.zipcode'),
			'tabindex' => '5'
		]
	) }}

<div class="form-group">
	<label for="inputLogo" class="col-sm-1 control-label">{{ trans('lingos::account.logo') }}:</label>
	<div class="col-sm-4">
		<div class="logo-container">
			@if ( isset($logo) )
				{{ Form::hidden('logo', Input::old('logo')) }}
				<img src="{{ Request::root() . $logo['thumb'] }}" class="logo">
			@else
				<span class="logo-alt">{{ trans('lingos::account.error.logo') }}</span>
			@endif
		</div>
	</div>
	<div class="col-sm-5">
		{{ Form::file('logo') }}
	</div>
</div>

<div class="form-group">
	<label for="inputStatus" class="col-sm-1 control-label">{{ trans('lingos::general.status') }}:</label>
	<div class="col-sm-11">
		{{
			Form::select(
				'status_id',
				$statuses,
				Input::old('status_id'),
				array(
					'class' => 'form-control chosen-select'
				)
			)
		}}
	</div>
</div>

<div class="form-group">
	<label for="inputDivision" class="col-sm-1 control-label">{{ trans('lingos::hr.division') }}:</label>
	<div class="col-sm-11">
		{{
			Form::select(
				'division_id',
				$divisions,
				Input::old('division_id'),
				array(
					'class' => 'form-control chosen-select'
				)
			)
		}}
	</div>
</div>

<div class="form-group">
	<label for="inputContact" class="col-sm-1 control-label">{{ trans('lingos::general.contact') }}:</label>
	<div class="col-sm-11">
		{{
			Form::select(
				'user_id',
				$contacts,
				Input::old('user_id'),
				array(
					'class' => 'form-control chosen-select'
				)
			)
		}}
	</div>
</div>

	{{ Bootstrap::text(
		'primary_phone',
		null,
		Input::old('primary_phone'),
		$errors,
		'phone fa-fw',
		[
			'id' => 'primary_phone',
			'placeholder' => trans('lingos::account.primary_phone'),
			'tabindex' => '10'
		]
	) }}

	{{ Bootstrap::text(
		'secondary_phone',
		null,
		Input::old('secondary_phone'),
		$errors,
		'fax fa-fw',
		[
			'id' => 'secondary_phone',
			'placeholder' => trans('lingos::account.secondary_phone'),
			'tabindex' => '11'
		]
	) }}

	{{ Bootstrap::text(
		'website',
		null,
		Input::old('website'),
		$errors,
		'link fa-fw',
		[
			'id' => 'website',
			'placeholder' => trans('lingos::general.website'),
			'tabindex' => '12'
		]
	) }}

	{{ Bootstrap::text(
		'email',
		null,
		Input::old('email'),
		$errors,
		'at fa-fw',
		[
			'id' => 'email',
			'placeholder' => trans('lingos::account.primary_email'),
			'tabindex' => '13'
		]
	) }}

	{{ Bootstrap::textarea(
		'notes',
		Input::old('notes'),
		null,
		$errors,
		'pencil fa-fw',
		[
			'id' => 'notes',
			'placeholder' => trans('lingos::general.notes'),
			'tabindex' => '14'
		]
	) }}

	<hr>

	{{ Bootstrap::submit(
		trans('lingos::button.save'),
		[
			'class' => 'btn btn-success btn-block'
		]
	) }}

	<div class="row">
		<div class="col-sm-4">
		{{ Bootstrap::linkIcon(
			'sites.index',
			trans('lingos::button.cancel'),
			'times fa-fw',
			[
				'class' => 'btn btn-default btn-block'
			]
		) }}
		</div>
		<div class="col-sm-4">
		{{ Bootstrap::reset(
			trans('lingos::button.reset'),
			[
				'class' => 'btn btn-default btn-block'
			]
		) }}
		</div>
		<div class="col-sm-4">
		{{ Bootstrap::linkIcon(
			'sites.destroy',
			trans('lingos::button.delete'),
			'trash-o fa-fw',
			array(
				'class' => 'btn btn-default btn-block action_confirm',
				'data-method' => 'delete',
				'title' => trans('lingos::account.command.delete')
			)
		) }}
		</div>
	</div>

{{ Form::close() }}
</div>
@stop
