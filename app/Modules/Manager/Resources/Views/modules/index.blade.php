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
			{
				data: 'id',
				name: 'id',
				searchable: false,
				visible: false
			},
			{
				data: 'name',
				name: 'name',
				orderable: true,
				searchable: true
			},
			{
				data: 'slug',
				name: 'slug',
				orderable: true,
				searchable: true
			},
			{
				data: 'version',
				name: 'version',
				orderable: true,
				searchable: true
			},
			{
				data: 'description',
				name: 'description',
				orderable: true,
				searchable: true
			},
			{
				data: 'enabled',
				name: 'enabled',
				orderable: true,
				searchable: false
			},
			{
				data: 'order',
				name: 'order',
				orderable: true,
				searchable: true
			},
			{
				data: 'actions',
				name: 'actions',
				orderable: false,
				searchable: false
			}
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
			<th></th>
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
