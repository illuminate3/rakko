@extends('app')

{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::account.user', 2) }} :: @parent
@stop

@section('styles')
	<link href="{{ asset('assets/admin/css/jquery.dataTables.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/admin/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@stop

@section('scripts')
	<script src="{{ asset('assets/admin/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/admin/js/dataTables.bootstrap.js') }}"></script>
	<script src="{{ asset('assets/admin/js/bootstrap-dataTables-paging.js') }}"></script>
@stop

@section('inline-scripts')
	var oTable;
	$(document).ready(function() {
		oTable = $('#table').dataTable({
			"sDom" : "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
			"sPaginationType" : "bootstrap",
			"bProcessing" : true,
			"bServerSide" : true,
			"sAjaxSource" : "{{ URL::to('admin/api/users') }}",
		});
	});
@stop



{{-- Content --}}
@section('content')
<div class="row">
<h1>
	<p class="pull-right">
{{--
	@if (Auth::check())
		@if (Auth::user()->hasRoleWithName('Admin'))
			{{ Bootstrap::linkIcon(
				'users.create',
				trans('lingos::button.user.new'),
				'plus fa-fw',
				array('class' => 'btn btn-info')
			) }}
		@endif
	@endif
--}}
	{{-- Bootstrap::linkIcon(
		'users.index',
		trans('kotoba::button.back'),
		'chevron-left fa-fw',
		array('class' => 'btn btn-default')
	) --}}
	</p>
	<i class="fa fa-group fa-lg"></i>
	{{ Lang::choice('kotoba::account.user', 2) }}
	<hr>
</h1>
</div>


<div class="page-header">
	<h3>
{{ Lang::choice('kotoba::account.user', 2) }}
	<div class="pull-right">
		<div class="pull-right">
            <a href="{{ URL::to('admin/users/create') }}" class="btn btn-sm  btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> {{ trans('kotoba::button.new') }}</a>
        </div>
	</div>
	</h3>
			"dom" : "T<'clear'>lfrtip",

</div>

<table id="table" class="table table-striped table-hover">
	<thead>
		<tr>
			<th>{{ trans('kotoba::account.name') }}</th>
			<th>{{ trans('kotoba::account.email') }}</th>
			<th>{{ trans('kotoba::general.activate') }}</th>
            <th>{{ trans('kotoba::general.created_at') }}</th>
            <th>{{ trans('kotoba::general.action') }}</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>
@stop
