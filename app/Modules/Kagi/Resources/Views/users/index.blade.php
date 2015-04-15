@extends('app')

{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::account.user', 2) }} :: @parent
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
		"ajax": "{{ URL::to('admin/api/users') }}",
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
				data: 'email',
				name: 'email',
				orderable: true,
				searchable: true
			},
			{
				data: 'blocked',
				name: 'blocked',
				orderable: true,
				searchable: false
			},
			{
				data: 'banned',
				name: 'banned',
				orderable: true,
				searchable: false
			},
			{
				data: 'confirmed',
				name: 'confirmed',
				orderable: true,
				searchable: false
			},
			{
				data: 'activated',
				name: 'activated',
				orderable: true,
				searchable: false
			},
			{
				data: 'created_at',
				name: 'created_at',
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
	<p class="pull-right">
	<a href="/admin/users/create" class="btn btn-primary" title="{{ trans('kotoba::button.new') }}">
		<i class="fa fa-plus fa-fw"></i>
		{{ trans('kotoba::button.new') }}
	</a>
	</p>
	<i class="fa fa-users fa-lg"></i>
		{{ Lang::choice('kotoba::account.user', 2) }}
	<hr>
</h1>
</div>


<div class="row">
<table id="table" class="table table-striped table-hover">
	<thead>
		<tr>
			<th></th>
			<th>{{ trans('kotoba::table.name') }}</th>
			<th>{{ trans('kotoba::table.email') }}</th>
			<th>{{ trans('kotoba::table.blocked') }}</th>
			<th>{{ trans('kotoba::table.banned') }}</th>
			<th>{{ trans('kotoba::table.confirmed') }}</th>
			<th>{{ trans('kotoba::table.activated') }}</th>
			<th>{{ trans('kotoba::table.created_at') }}</th>

			<th>{{ Lang::choice('kotoba::table.action', 2) }}</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>
</div>


@stop
