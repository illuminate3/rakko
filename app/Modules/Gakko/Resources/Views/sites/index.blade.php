@extends('app')

{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::hr.site', 2) }} :: @parent
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
		"ajax": "{{ URL::to('/api/sites') }}",
		"columns": [
			{data: 'id', name: 'id'},
			{data: 'name', name: 'name'},
			{data: 'division_id', name: 'division_id'},
			{data: 'website', name: 'website'},
			{data: 'user_id', name: 'user_id'},
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
	<a href="/sites/create" class="btn btn-primary" title="{{ trans('kotoba::button.new') }}">
		<i class="fa fa-plus fa-fw"></i>
		{{ trans('kotoba::button.new') }}
	</a>
	</p>
	<i class="fa fa-angle-double-right fa-lg"></i>
		{{ Lang::choice('kotoba::hr.site', 2) }}
	<hr>
</h1>
</div>


<div class="row">
<table id="table" class="table table-striped table-hover">
	<thead>
		<tr>
			<th>{{ trans('kotoba::table.id') }}</th>
			<th>{{ trans('kotoba::table.name') }}</th>
			<th>{{ trans('kotoba::table.division') }}</th>
			<th>{{ trans('kotoba::table.website') }}</th>
			<th>{{ trans('kotoba::table.supervisior') }}</th>

			<th>{{ Lang::choice('kotoba::table.action', 2) }}</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>
</div>

@stop
