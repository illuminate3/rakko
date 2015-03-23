@extends('app')

{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::hr.employee', 2) }} :: @parent
@stop

@section('styles')
	<link href="{{ asset('assets/vendors/DataTables-1.10.5/plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">
@stop

@section('scripts')
	<script src="{{ asset('assets/vendors/DataTables-1.10.5/media/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/vendors/DataTables-1.10.5/plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
@stop

@section('inline-scripts')
$(document).ready(function() {
oTable =
	$('#table').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "{{ URL::to('/api/employees') }}",
		"columns": [
			{data: 'id', name: 'id'},
			{data: 'first_name', name: 'first_name'},
			{data: 'middle_initial', name: 'middle_initial'},
			{data: 'last_name', name: 'last_name'},
			{data: 'email_1', name: 'email_1'},
			{data: 'actions', name: 'actions'}
		]
	});
});
@stop


{{-- Content --}}
@section('content')

<div class="row">
<h1>
	<p class="pull-right">
	<a href="/employees/create" class="btn btn-primary" title="{{ trans('kotoba::button.new') }}">
		<i class="fa fa-plus fa-fw"></i>
		{{ trans('kotoba::button.new') }}
	</a>
	</p>
	<i class="fa fa-angle-double-right fa-lg"></i>
		{{ Lang::choice('kotoba::hr.employee', 2) }}
	<hr>
</h1>
</div>


<div class="row">
<table id="table" class="table table-striped table-hover">
	<thead>
		<tr>
			<th>{{ trans('kotoba::table.id') }}</th>
			<th>{{ trans('kotoba::table.first_name') }}</th>
			<th>{{ trans('kotoba::table.middle_initial') }}</th>
			<th>{{ trans('kotoba::table.last_name') }}</th>
			<th>{{ trans('kotoba::table.email') }}</th>

			<th>{{ Lang::choice('kotoba::table.action', 2) }}</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>
</div>

@stop
