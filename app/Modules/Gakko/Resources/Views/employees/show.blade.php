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
	<i class="fa fa-user fa-lg"></i>
	{{-- trans('kotoba::general.command.edit') --}}
	{{{ $employee->profile->prefix }}}&nbsp;{{{ $employee->profile->first_name }}}&nbsp;{{{ $employee->profile->middle_initial }}}&nbsp;{{{ $employee->profile->last_name }}}&nbsp;{{{ $employee->profile->suffix }}}
	<hr>
</h1>
</div>


<div class="row">

<div class="table-responsive">
<table class="table table-striped table-hover">
	<tbody>
		<tr>
			<td class="col-sm-2">
				{{ Lang::choice('kotoba::hr.employee_type', 1) }}
			</td>
			<td class="col-sm-10">
				{{ $employee->employee_type_id }}
			</td>
		</tr>
		<tr>
			<td class="col-sm-2">
				{{ Lang::choice('kotoba::hr.department', 2) }}
			</td>
			<td class="col-sm-10">
				{!! $employee->present()->departments !!}
			</td>
		</tr>
		<tr>
			<td class="col-sm-2">
				{{ Lang::choice('kotoba::hr.job_title', 2) }}
			</td>
			<td class="col-sm-10">
				{{-- $employee->jobtitles --}}
			</td>
		</tr>
		<tr>
			<td class="col-sm-2">
				{{ Lang::choice('kotoba::hr.grade', 2) }}
			</td>
			<td class="col-sm-10">
				{!! $employee->present()->grades !!}
			</td>
		</tr>
		<tr>
			<td class="col-sm-2">
				{{ Lang::choice('kotoba::hr.subject', 2) }}
			</td>
			<td class="col-sm-10">
				{!! $employee->present()->subjects !!}
			</td>
		</tr>
		<tr>
			<td class="col-sm-2">
				{{ Lang::choice('kotoba::hr.site', 2) }}
			</td>
			<td class="col-sm-10">
				{!! $employee->present()->sites !!}
			</td>
		</tr>
		<tr>
			<td class="col-sm-2">
				{{ trans('kotoba::hr.ask.isSupervisior') }}
			</td>
			<td class="col-sm-10">
				{{ $employee->present()->isSupervisior }}
			</td>
		</tr>
		<tr>
			<td class="col-sm-2">
				{{ trans('kotoba::hr.supervisor') }}
			</td>
			<td class="col-sm-10">
				{{ $employee->present()->getSupervisior($employee->supervisor_id) }}
			</td>
		</tr>
	</tbody>
</table>
</div><!-- ./responsive -->



<hr>

<div class="row">
	<div class="col-sm-4">
		<a href="/employees" class="btn btn-default btn-block" title="{{ trans('kotoba::button.back') }}">
			<i class="fa fa-chevron-left fa-fw"></i>
			{{ trans('kotoba::button.back') }}
		</a>
	</div>
	<div class="col-sm-4">
		<a href="/employees/{{ $employee->id }}/edit" class="btn btn-success btn-block" title="{{ trans('kotoba::button.edit') }}">
			<i class="fa fa-pencil fa-fw"></i>
			{{ trans('kotoba::button.edit') }}
		</a>
	</div>
	<div class="col-sm-4">
		<a class="btn btn-danger btn-block action_confirm" data-method="delete" title="{{ trans('kotoba::general.command.delete') }}" onclick="">
			<i class="fa fa-trash-o fa-fw"></i>
			{{ trans('kotoba::general.command.delete') }}
		</a>
	</div>
</div>


</div> <!-- ./ row -->
</div> <!-- ./ wrap/container -->
@stop
