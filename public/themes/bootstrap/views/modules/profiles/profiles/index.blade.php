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
		"ajax": "{{ URL::to('api/profiles') }}",
		"columns": [
			{
				data: 'id',
				name: 'id',
				searchable: false,
				visible: false
			},
			{
				data: 'first_name',
				name: 'first_name',
				orderable: true,
				searchable: true
			},
			{
				data: 'last_name',
				name: 'last_name',
				orderable: true,
				searchable: true
			},
			{
				data: 'email_1',
				name: 'email_1',
				orderable: true,
				searchable: true
			},
			{
				data: 'email_2',
				name: 'email_2',
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
{{--
	<a href="/profiles/create" class="btn btn-primary" title="{{ trans('kotoba::button.new') }}">
		<i class="fa fa-plus fa-fw"></i>
		{{ trans('kotoba::button.new') }}
	</a>
--}}
	</p>
	<i class="fa fa-users fa-lg"></i>
		{{ Lang::choice('kotoba::account.profile', 2) }}
	<hr>
</h1>
</div>


<div class="row">
<table id="table" class="table table-striped table-hover">
	<thead>
		<tr>
			<th></th>
			<th>{{ trans('kotoba::account.first_name') }}</th>
			<th>{{ trans('kotoba::account.last_name') }}</th>
			<th>{{ trans('kotoba::account.primary_email') }}</th>
			<th>{{ trans('kotoba::account.email_2') }}</th>

			<th>{{ Lang::choice('kotoba::table.action', 2) }}</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>
</div>


@stop
