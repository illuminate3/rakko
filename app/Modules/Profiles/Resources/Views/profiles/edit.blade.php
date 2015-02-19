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
		'profiles.index',
		trans('lingos::button.back'),
		'chevron-left fa-fw',
		array('class' => 'btn btn-default')
	) }}
	</p>
	<i class="fa fa-edit fa-lg"></i>
		{{{ $profile->first_name }}}&nbsp;{{{ $profile->last_name }}}
	<hr>
</h1>
</div>


<div class="row">
{{ Form::open(
	[
		'route' => array('profiles.update', $profile->id),
		'profile' => 'form',
		'method' => 'PATCH',
		'class' => 'form-horizontal',
		'files' => true
	]
) }}


	{{ Bootstrap::text(
		'prefix',
		null,
		$profile->prefix,
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
		$profile->first_name,
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
		$profile->middle_initial,
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
		$profile->last_name,
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
		$profile->suffix,
		$errors,
		'angle-double-right fa-fw',
		[
			'id' => 'suffix',
			'placeholder' => trans('lingos::account.suffix'),
			'tabindex' => '5'
		]
	) }}

	{{ Bootstrap::text(
		'email',
		null,
		$profile->email,
		$errors,
		'at fa-fw',
		[
			'id' => 'email',
			'placeholder' => trans('lingos::general.email'),
			'tabindex' => '6'
		]
	) }}

	{{ Bootstrap::text(
		'secondary_email',
		null,
		$profile->secondary_email,
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
		$profile->primary_phone,
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
		$profile->secondary_phone,
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
		$profile->address,
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
		$profile->city,
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
		$profile->state,
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
		$profile->zipcode,
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
		$profile->notes,
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
				$profile->employee_type_id,
				array(
					'class' => 'form-control chosen-select',
					'tabindex' => '14'
				)
			)
		}}
	</div>
</div>

		{{--
<div class="form-group">
	<label for="inputDepartment" class="col-sm-2 control-label">{{ trans('lingos::hr.department') }}:</label>
	<div class="col-sm-10">
			Form::select(
				'department_id[]',
				$departments,
				$profile->department_id,
				array(
					'class' => 'form-control chosen-select',
					'multiple' => true,
					'tabindex' => '15'
				)
			)
	</div>
</div>
		--}}
<div class="form-group">
	<label for="inputDepartments" class="col-sm-2 control-label">{{ trans('lingos::hr.department') }}:</label>
	<div class="col-sm-10">
		@foreach (HR\models\Department::All() as $department)
			<label class="checkbox-inline">
				{{ Form::checkbox('departments[]', $department->id, $profile->hasDepartment($department->id)) }}
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
				$profile->job_title_id,
				array(
					'class' => 'form-control chosen-select',
					'tabindex' => '16'
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
						'tabindex' => '17',
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
						'tabindex' => '18',
					)
				)
			}}
			No
		</label>
	</div>
</div>

@if ($profile->isSupervisior != '1')
<div class="form-group">
	<label for="inputSupervisor" class="col-sm-2 control-label">{{ trans('lingos::hr.supervisor') }}:</label>
	<div class="col-sm-10">
		{{
			Form::select(
				'supervisor_id',
				$supervisors,
				$profile->supervisor_id,
				array(
					'class' => 'form-control chosen-select',
					'tabindex' => '19'
				)
			)
		}}
	</div>
</div>
@endif

{{--
<div class="form-group">
	<label for="inputGrades" class="col-sm-2 control-label">{{ trans('lingos::hr.grade') }}:</label>
	<div class="col-sm-10">
			Form::select(
				'grade_id[]',
				$grades,
				$profile->grade_id,
				array(
					'class' => 'form-control chosen-select',
					'multiple' => true,
					'tabindex' => '20'
				)
			)
	</div>
</div>
--}}
<div class="form-group">
	<label for="inputGrades" class="col-sm-2 control-label">{{ trans('lingos::hr.grade') }}:</label>
	<div class="col-sm-10">
		@foreach (HR\models\Grade::All() as $grade)
			<label class="checkbox-inline">
				{{ Form::checkbox('grades[]', $grade->id, $profile->hasGrade($grade->id)) }}
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
				$profile->subject_id,
				array(
					'class' => 'form-control chosen-select',
					'tabindex' => '21'
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
				{{ Form::checkbox('subjects[]', $subject->id, $profile->hasSubject($subject->id)) }}
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
				$profile->position_id,
				array(
					'class' => 'form-control chosen-select',
					'tabindex' => '22'
				)
			)
		}}
	</div>
</div>


{{--
<div class="form-group">
	<label for="inputSite" class="col-sm-2 control-label">{{ trans('lingos::hr.site') }}:</label>
	<div class="col-sm-10">
			Form::select(
				'sites[]',
				$sites,
				$profile->site_id,
//				$profile->hasSite($site->id),
				array(
					'class' => 'form-control chosen-select',
					'multiple' => true,
					'tabindex' => '23'
				)
			)
	</div>
</div>
--}}
<div class="form-group">
	<label for="inputSites" class="col-sm-2 control-label">{{ trans('lingos::hr.site') }}:</label>
	<div class="col-sm-10">
		@foreach (HR\models\Site::All() as $site)
			<label class="checkbox-inline">
				{{ Form::checkbox('sites[]', $site->id, $profile->hasSite($site->id)) }}
				{{ $site->name }}
			</label>
		@endforeach
	</div>
</div>
<br>
<br>


@endif
@endif

{{--
<div class="form-group">
	<label for="inputLogo" class="col-sm-2 control-label">{{ trans('lingos::account.picture') }}:</label>
	<div class="col-sm-4">
		<div class="logo-container">
			@if ($picture)
				{{ Form::hidden('picture', $profile->picture) }}

				<img
						src="{{ $profile->picture }}"
					alt="{{ Auth::user()->email }}"
					class="img-circle profile"
				/>

			@else
				<span class="logo-alt">{{ trans('lingos::account.error.logo') }}</span>
			@endif
		</div>
	</div>
	<div class="col-sm-6">
		{{ Form::file('picture') }}
	</div>
</div>
--}}

	<hr>

	{{ Bootstrap::submit(
		trans('lingos::button.save'),
		[
			'class' => 'btn btn-success btn-block'
		]
	) }}

	<div class="row">

@if (Auth::check())
@if (Auth::user()->hasRoleWithName('Admin'))
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
@else
		<div class="col-sm-6">
		{{ Bootstrap::linkIcon(
			'profiles.index',
			trans('lingos::button.cancel'),
			'times fa-fw',
			[
				'class' => 'btn btn-default btn-block'
			]
		) }}
		</div>
		<div class="col-sm-6">
		{{ Bootstrap::reset(
			trans('lingos::button.reset'),
			[
				'class' => 'btn btn-default btn-block'
			]
		) }}
		</div>

@endif
@endif
	</div>

{{ Form::close() }}
</div>
@stop
