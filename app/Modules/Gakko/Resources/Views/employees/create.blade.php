@extends('app')

{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::hr.employee', 2) }} :: @parent
@stop

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/chosen_v1.0.0/chosen.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/chosen_v1.0.0/chosen_bootstrap.css') }}">
@stop

@section('scripts')
	<script type="text/javascript" src="{{ asset('assets/vendors/chosen_v1.0.0/chosen.jquery.min.js') }}"></script>
@stop

@section('inline-scripts')
	jQuery(document).ready(function($) {
		$(".chosen-select").chosen();
	});
@stop


{{-- Content --}}
@section('content')

<div id="wrap" class="container">

<div class="row">
<h1>
	<p class="pull-right">
	<a href="/employees" class="btn btn-default" title="{{ trans('kotoba::button.back') }}">
		<i class="fa fa-chevron-left fa-fw"></i>
		{{ trans('kotoba::button.back') }}
	</a>
	</p>
	<i class="fa fa-edit fa-lg"></i>
	{{ trans('kotoba::general.command.create') }}
	<hr>
</h1>
</div>


<div class="row">
{!! Form::open([
	'url' => 'employees',
	'method' => 'POST',
	'class' => 'form'
]) !!}


<div class="form-group padding-bottom-xl">
	<label for="inputEmployeeType" class="col-sm-2 control-label">{{ Lang::choice('kotoba::hr.employee_type', 1) }}:</label>
	<div class="col-sm-10">
		{!!
			Form::select(
				'employee_type_id',
				$employeeTypes,
				Input::old('employee_type_id'),
				array(
					'class' => 'form-control chosen-select'
				)
			)
		!!}
	</div>
</div>

<div class="form-group padding-bottom-xl">
	<label for="inputDepartment" class="col-sm-2 control-label">{{ Lang::choice('kotoba::hr.department',2 ) }}:</label>
	<div class="col-sm-10">
		{!!
			Form::select(
				'department_id',
				$departments,
				Input::old('department_id'),
				array(
					'class' => 'form-control chosen-select',
					'data-placeholder' => trans('kotoba::general.command.select') . '&nbsp;' . Lang::choice('kotoba::hr.department', 2),
					'multiple' => true
				)
			)
		!!}
	</div>
</div>
{{--
<div class="form-group padding-bottom-xl">
	<label for="inputDepartments" class="col-sm-2 control-label">{{ Lang::choice('kotoba::hr.department',2 ) }}:</label>
	<div class="col-sm-10">
		@foreach (Department::All() as $department)
			<label class="checkbox-inline">
				{{ Form::checkbox('departments[]', $department->id, $employee->hasDepartment($department->id)) }}
				{{ $department->name }}
			</label>
		@endforeach
	</div>
</div>
--}}

<div class="form-group padding-bottom-xl">
	<label for="inputJobTitle1" class="col-sm-2 control-label">{{ Lang::choice('kotoba::hr.job_title', 1) }}:</label>
	<div class="col-sm-10">
		{!!
			Form::select(
				'job_title_id',
				$jobTitles,
				Input::old('job_title_id'),
				array(
					'class' => 'form-control chosen-select'
				)
			)
		!!}
	</div>
</div>

<div class="form-group padding-bottom-xl">
	<label for="inputIsSupervisior" class="col-sm-2 control-label">{{ trans('kotoba::hr.ask.isSupervisior') }}:</label>
	<div class="col-sm-10">
		<label class="radio-inline">
			{!!
				Form::radio(
					'isSupervisior',
					'1',
					false,
					array(
						'id' => 'inputIsSupervisior'
					)
				)
			!!}
			{{ trans('kotoba::general.yes') }}
		</label>
		<label class="radio-inline">
			{!!
				Form::radio(
					'isSupervisior',
					'0',
					true,
					array(
						'id' => 'inputIsSupervisior'
					)
				)
			!!}
			{{ trans('kotoba::general.no') }}
		</label>
	</div>
</div>

<div class="form-group padding-bottom-xl">
	<label for="inputSupervisor" class="col-sm-2 control-label">{{ trans('kotoba::hr.supervisor') }}:</label>
	<div class="col-sm-10">
		{!!
			Form::select(
				'supervisor_id',
				$supervisors,
				Input::old('supervisor_id'),
				array(
					'class' => 'form-control chosen-select'
				)
			)
		!!}
	</div>
</div>

<div class="form-group padding-bottom-xl">
	<label for="inputGrades" class="col-sm-2 control-label">{{ Lang::choice('kotoba::hr.grade', 2) }}:</label>
	<div class="col-sm-10">
		{!!
			Form::select(
				'grade_id[]',
				$grades,
				Input::old('grade_id'),
				array(
					'class' => 'form-control chosen-select',
					'data-placeholder' => trans('kotoba::general.command.select') . '&nbsp;' . Lang::choice('kotoba::hr.grade', 2),
					'multiple' => true
				)
			)
		!!}
	</div>
</div>
{{--
<div class="form-group padding-bottom-xl">
	<label for="inputGrades" class="col-sm-2 control-label">{{ Lang::choice('kotoba::hr.grade', 2) }}:</label>
	<div class="col-sm-10">
		@foreach (Grade::All() as $grade)
			<label class="checkbox-inline">
				{{ Form::checkbox('grades[]', $grade->id, $profile->hasGrade($grade->id)) }}
				{{ $grade->name }}
			</label>
		@endforeach
	</div>
</div>
--}}

<div class="form-group padding-bottom-xl">
	<label for="inputSubject" class="col-sm-2 control-label">{{ Lang::choice('kotoba::hr.subject', 2) }}:</label>
	<div class="col-sm-10">
		{!!
			Form::select(
				'subject_id',
				$subjects,
				Input::old('subject_id'),
				array(
					'class' => 'form-control chosen-select',
					'data-placeholder' => trans('kotoba::general.command.select') . '&nbsp;' . Lang::choice('kotoba::hr.subject', 2),
					'multiple' => true
				)
			)
		!!}
	</div>
</div>
{{--
<div class="form-group padding-bottom-xl">
	<label for="inputSubjects" class="col-sm-2 control-label">{{ Lang::choice('kotoba::hr.subject', 2) }}:</label>
	<div class="col-sm-10">
		@foreach (Subject::All() as $subject)
			<label class="checkbox-inline">
				{{ Form::checkbox('subjects[]', $subject->id, $profile->hasSubject($subject->id)) }}
				{{ $subject->name }}
			</label>
		@endforeach
	</div>
</div>
--}}

<div class="form-group padding-bottom-xl">
	<label for="inputPosition" class="col-sm-2 control-label">{{ Lang::choice('kotoba::hr.position', 1) }}:</label>
	<div class="col-sm-10">
		{!!
			Form::select(
				'position_id',
				$positions,
				Input::old('position_id'),
				array(
					'class' => 'form-control chosen-select'
				)
			)
		!!}
	</div>
</div>

<div class="form-group padding-bottom-xl">
	<label for="inputSite" class="col-sm-2 control-label">{{ Lang::choice('kotoba::hr.site', 2) }}:</label>
	<div class="col-sm-10">
		{!!
			Form::select(
				'sites[]',
				$sites,
				Input::old('site_id'),
//				$employee->hasSite($site->id),
				array(
					'class' => 'form-control chosen-select',
					'data-placeholder' => trans('kotoba::general.command.select') . '&nbsp;' . Lang::choice('kotoba::hr.site', 2),
					'multiple' => true
				)
			)
		!!}
	</div>
</div>
{{--
<div class="form-group padding-bottom-xl">
	<label for="inputSites" class="col-sm-2 control-label">{{ Lang::choice('kotoba::hr.site', 2) }}:</label>
	<div class="col-sm-10">
		@foreach (Site::All() as $site)
			<label class="checkbox-inline">
				{{ Form::checkbox('sites[]', $site->id, $profile->hasSite($site->id)) }}
				{{ $site->name }}
			</label>
		@endforeach
	</div>
</div>
--}}


<hr>


<div class="form-group">
	<input class="btn btn-success btn-block" type="submit" value="{{ trans('kotoba::button.save') }}">
</div>

{!! Form::close() !!}


<div class="row">
<div class="col-sm-4">
	<a href="/employees" class="btn btn-default btn-block" title="{{ trans('kotoba::button.cancel') }}">
		<i class="fa fa-times fa-fw"></i>
		{{ trans('kotoba::button.cancel') }}
	</a>
</div>

<div class="col-sm-4">
	<input class="btn btn-default btn-block" type="reset" value="{{ trans('kotoba::button.reset') }}">
</div>

<div class="col-sm-4">
<a class="btn btn-default btn-block action_confirm" data-method="delete" title="{{ trans('kotoba::general.command.delete') }}" onclick="">
	<i class="fa fa-trash-o fa-fw"></i>
	{{ trans('kotoba::general.command.delete') }}
</a>
</div>
</div>

</div> <!-- ./ row -->
</div> <!-- ./ wrap/container -->
@stop
