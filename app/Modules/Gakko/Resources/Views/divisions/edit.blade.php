@extends(Config::get('vedette.vedette_views.layout'))

@section('title')
@parent
	{{ Config::get('vedette.vedette_html.separator') }}
	{{ trans('lingos::general.command.edit') }}
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
		'admin.divisions.index',
		trans('lingos::button.back'),
		'chevron-left fa-fw',
		array('class' => 'btn btn-default')
	) }}
	</p>
	<i class="fa fa-edit fa-lg"></i>
	{{ trans('lingos::general.command.edit') }}
	<hr>
</h1>
</div>


<div class="row">
{{ Form::open(
	[
		'route' => array('admin.divisions.update', $division->id),
		'division' => 'form',
		'method' => 'PATCH'
	]
) }}


	{{ Bootstrap::text(
		'name',
		null,
		$division->name,
		$errors,
		'tag fa-fw',
		[
			'id' => 'name',
			'placeholder' => trans('lingos::general.name'),
			'required',
			'autofocus'
		]
	) }}

	{{ Bootstrap::text(
		'description',
		null,
		$division->description,
		$errors,
		'info fa-fw',
		[
			'id' => 'name',
			'placeholder' => trans('lingos::general.description'),
			'required'
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
			'admin.divisions.index',
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
			'admin.divisions.destroy',
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
