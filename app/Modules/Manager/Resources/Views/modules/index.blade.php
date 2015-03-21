@extends('app')

{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::account.profile', 2) }} :: @parent
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
		"ajax": "{{ URL::to('admin/api/manager') }}",
		"columns": [
			{data: 'name', name: 'name'},
			{data: 'slug', name: 'slug'},
			{data: 'version', name: 'version'},
			{data: 'description', name: 'description'},
			{data: 'enabled', name: 'enabled'},
			{data: 'order', name: 'order'},
			{data: 'actions', name: 'actions'}
		]
	});
});
@stop



{{-- Content --}}
@section('content')

<div class="row">
<h1>
	<i class="fa fa-gears fa-lg"></i>
		{{ Lang::choice('kotoba::module.module', 2) }}
	<hr>
</h1>
</div>


<div class="row">

<table id="table" class="table table-striped table-hover">
	<thead>
		<tr>
			<th>{{ trans('kotoba::table.name') }}</th>
			<th>{{ trans('kotoba::table.slug') }}</th>
			<th>{{ trans('kotoba::table.version') }}</th>
			<th>{{ trans('kotoba::table.description') }}</th>
			<th>{{ trans('kotoba::table.enabled') }}</th>
			<th>{{ trans('kotoba::table.order') }}</th>

			<th>{{ Lang::choice('kotoba::table.action', 2) }}</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>

</div>

@stop

