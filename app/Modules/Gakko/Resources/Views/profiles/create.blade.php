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
		'profiles.index',
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
		'route' => array('profiles.store'),
		'class' => 'form-horizontal',
		'role' => 'form',
		'files' => true
	]
) }}
@if ( Config::get('vedette.vedette_settings.add_profile') == True )
	{{ Form::hidden('user_id', $user_id) }}
@endif


	{{ Bootstrap::text(
		'prefix',
		null,
		Input::old('prefix'),
		$errors,
		'angle-double-left fa-fw',
		[
			'id' => 'prefix',
			'placeholder' => trans('lingos::account.prefix'),
			'autofocus',
			'tabindex' => '1'
		]
	) }}

	{{ Bootstrap::text(
		'first_name',
		null,
		Input::old('first_name'),
		$errors,
		'angle-left fa-fw',
		[
			'id' => 'first_name',
			'placeholder' => trans('lingos::account.first_name'),
			'required',
			'tabindex' => '2'
		]
	) }}

	{{ Bootstrap::text(
		'middle_initial',
		null,
		Input::old('middle_initial'),
		$errors,
		'arrows-h fa-fw',
		[
			'id' => 'middle_initial',
			'placeholder' => trans('lingos::account.middle_initial'),
			'tabindex' => '3'
		]
	) }}

	{{ Bootstrap::text(
		'last_name',
		null,
		Input::old('last_name'),
		$errors,
		'angle-right fa-fw',
		[
			'id' => 'last_name',
			'placeholder' => trans('lingos::account.last_name'),
			'tabindex' => '4'
		]
	) }}

	{{ Bootstrap::text(
		'suffix',
		null,
		Input::old('suffix'),
		$errors,
		'angle-double-right fa-fw',
		[
			'id' => 'suffix',
			'placeholder' => trans('lingos::account.suffix'),
			'tabindex' => '5'
		]
	) }}


@if ( Config::get('vedette.vedette_settings.add_profile') == True )
	{{ Bootstrap::text(
		'email',
		null,
		$email,
		$errors,
		'at fa-fw',
		[
			'id' => 'email',
			'placeholder' => trans('lingos::general.email'),
			'tabindex' => '6'
		]
	) }}
@else
	{{ Bootstrap::text(
		'email',
		null,
		Input::old('email'),
		$errors,
		'at fa-fw',
		[
			'id' => 'email',
			'placeholder' => trans('lingos::general.email'),
			'tabindex' => '6'
		]
	) }}
@endif


	{{ Bootstrap::text(
		'secondary_email',
		null,
		Input::old('secondary_email'),
		$errors,
		'at fa-fw',
		[
			'id' => 'secondary_email',
			'placeholder' => trans('lingos::account.secondary_email'),
			'tabindex' => '7'
		]
	) }}

	{{ Bootstrap::text(
		'primary_phone',
		null,
		Input::old('primary_phone'),
		$errors,
		'phone fa-fw',
		[
			'id' => 'primary_phone',
			'placeholder' => trans('lingos::account.primary_phone'),
			'tabindex' => '8'
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
			'tabindex' => '9'
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
			'tabindex' => '10'
		]
	) }}

	{{ Bootstrap::text(
		'city',
		null,
		Input::old('city'),
		$errors,
		'home fa-fw',
		[
			'id' => 'city',
			'placeholder' => trans('lingos::account.city'),
			'tabindex' => '11'
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
			'tabindex' => '12'
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
			'tabindex' => '13'
		]
	) }}

	{{ Bootstrap::textarea(
		'notes',
		null,
		Input::old('notes'),
		$errors,
		'pencil fa-fw',
		[
			'id' => 'notes',
			'placeholder' => trans('lingos::general.notes'),
			'tabindex' => '13'
		]
	) }}

@if (Auth::check())
@if (Auth::user()->hasRoleWithName('Admin'))

<div class="form-group">
	<label for="inputEmployeeType" class="col-sm-2 control-label">{{ trans('lingos::hr.employee_type') }}:</label>
	<div class="col-sm-10">
		{{
			Form::select(
				'employee_type_id',
				$employeeTypes,
				Input::old('employee_type_id'),
				array(
					'class' => 'form-control chosen-select'
				)
			)
		}}
	</div>
</div>

{{--
<div class="form-group">
	<label for="inputDepartment" class="col-sm-2 control-label">{{ trans('lingos::hr.department') }}:</label>
	<div class="col-sm-10">
		{{
			Form::select(
				'department_id[]',
				$departments,
				Input::old('department_id'),
				array(
					'class' => 'form-control chosen-select',
					'multiple' => true,
					'tabindex' => '4'
				)
			)
		}}
	</div>
</div>
--}}
<div class="form-group">
	<label for="inputDepartments" class="col-sm-2 control-label">{{ trans('lingos::hr.department') }}:</label>
	<div class="col-sm-10">
		@foreach (HR\models\Department::All() as $department)
			<label class="checkbox-inline">
				{{ Form::checkbox('department_id[]', $department->id) }}
				{{ $department->name }}
			</label>
		@endforeach
	</div>
</div>

<div class="form-group">
	<label for="inputJobTitle1" class="col-sm-2 control-label">{{ trans('lingos::hr.job_title') }}:</label>
	<div class="col-sm-10">
		{{
			Form::select(
				'job_title_id',
				$jobTitles,
				Input::old('job_title_id'),
				array(
					'class' => 'form-control chosen-select'
				)
			)
		}}
	</div>
</div>

<div class="form-group">
	<label for="inputIsSupervisior" class="col-sm-2 control-label">{{ trans('lingos::hr.ask.isSupervisior') }}:</label>
	<div class="col-sm-10">
		<label class="radio-inline">
			{{
				Form::radio(
					'isSupervisior',
					'1',
					false,
					array(
						'id' => 'inputIsSupervisior',
						'tabindex' => '20',
					)
				)
			}}
			Yes
		</label>
		<label class="radio-inline">
			{{
				Form::radio(
					'isSupervisior',
					'0',
					true,
					array(
						'id' => 'inputIsSupervisior',
						'tabindex' => '20',
					)
				)
			}}
			No
		</label>
	</div>
</div>

<div class="form-group">
	<label for="inputSupervisor" class="col-sm-2 control-label">{{ trans('lingos::hr.supervisor') }}:</label>
	<div class="col-sm-10">
		{{
			Form::select(
				'supervisor_id',
				$supervisors,
				Input::old('supervisor_id'),
				array(
					'class' => 'form-control chosen-select'
				)
			)
		}}
	</div>
</div>

{{--
<div class="form-group">
	<label for="inputGrades" class="col-sm-2 control-label">{{ trans('lingos::hr.grade') }}:</label>
	<div class="col-sm-10">
		{{
			Form::select(
				'grade_id',
				$grades,
				Input::old('grade_id'),
				array(
					'class' => 'form-control chosen-select'
				)
			)
		}}
	</div>
</div>
--}}
<div class="form-group">
	<label for="inputGrades" class="col-sm-2 control-label">{{ trans('lingos::hr.grade') }}:</label>
	<div class="col-sm-10">
		@foreach (HR\models\Grade::All() as $grade)
			<label class="checkbox-inline">
				{{ Form::checkbox('grades[]', $grade->id) }}
				{{ $grade->name }}
			</label>
		@endforeach
	</div>
</div>

{{--
<div class="form-group">
	<label for="inputSubject" class="col-sm-2 control-label">{{ trans('lingos::hr.subject') }}:</label>
	<div class="col-sm-10">
		{{
			Form::select(
				'subject_id',
				$subjects,
				Input::old('subject_id'),
				array(
					'class' => 'form-control chosen-select'
				)
			)
		}}
	</div>
</div>
--}}
<div class="form-group">
	<label for="inputSubjects" class="col-sm-2 control-label">{{ trans('lingos::hr.subject') }}:</label>
	<div class="col-sm-10">
		@foreach (HR\models\Subject::All() as $subject)
			<label class="checkbox-inline">
				{{ Form::checkbox('subjects[]', $subject->id) }}
				{{ $subject->name }}
			</label>
		@endforeach
	</div>
</div>

<div class="form-group">
	<label for="inputPosition" class="col-sm-2 control-label">{{ trans('lingos::hr.position') }}:</label>
	<div class="col-sm-10">
		{{
			Form::select(
				'position_id',
				$positions,
				Input::old('position_id'),
				array(
					'class' => 'form-control chosen-select'
				)
			)
		}}
	</div>
</div>

{{--
<div class="form-group">
	<label for="inputSite" class="col-sm-2 control-label">{{ trans('lingos::hr.site') }}:</label>
	<div class="col-sm-10">
		{{
			Form::select(
				'site_id',
				$sites,
				Input::old('site_id'),
				array(
					'class' => 'form-control chosen-select'
				)
			)
		}}
	</div>
</div>
--}}
<div class="form-group">
	<label for="inputSites" class="col-sm-2 control-label">{{ trans('lingos::hr.site') }}:</label>
	<div class="col-sm-10">
		@foreach (HR\models\Site::All() as $site)
			<label class="checkbox-inline">
				{{ Form::checkbox('sites[]', $site->id) }}
				{{ $site->name }}
			</label>
		@endforeach
	</div>
</div>

@endif
@endif

<div class="form-group">
	<label for="inputLogo" class="col-sm-2 control-label">{{ trans('lingos::account.picture') }}:</label>
	<div class="col-sm-4">
		<div class="logo-container">
			@if (isset($picture))
				{{ Form::hidden('picture', Input::old('picture')) }}
				<img src="{{ Request::root() . $logo['thumb'] }}" class="logo">
			@else
				<span class="logo-alt">{{ trans('lingos::account.error.logo') }}</span>
			@endif
		</div>
	</div>
	<div class="col-sm-6">
		{{ Form::file('picture') }}
	</div>
</div>

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
			'profiles.index',
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
			'profiles.destroy',
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
