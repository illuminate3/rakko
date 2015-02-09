@extends('app')

@section('title')
@parent
	{{ Config::get('general.separator') }}
	{{ trans('kotoba::role.roles') }}
@stop

@section('styles')
	<link rel="stylesheet" href="{{ asset('packages/illuminate3/vedette/assets/vendors/Datatables-Bootstrap3/BS3/assets/css/datatables.css') }}">
@stop

@section('scripts')
	<script src="{{ asset('packages/illuminate3/vedette/assets/js/restfulizer.js') }}"></script>
	<script src="{{ asset('packages/illuminate3/vedette/assets/vendors/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('packages/illuminate3/vedette/assets/vendors/Datatables-Bootstrap3/BS3/assets/js/datatables.js') }}"></script>
@stop

@section('inline-scripts')

var text_confirm_message = '{{ trans('kotoba::role.ask.delete') }}';

$(document).ready(function() {

	$('#DataTable').dataTable({
		stateSave: true
	});
	$('#DataTable').each(function(){
		var datatable = $(this);
		var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
		search_input.attr('placeholder', 'Search');
		search_input.addClass('form-control input-sm');
		var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
		length_sel.addClass('form-control input-sm');
	});

});
@stop

@section('content')
<div class="row">
<h1>
	<p class="pull-right">
	</p>
	<i class="fa fa-gavel fa-lg"></i>
	{{ Lang::choice('kotoba::role.role', 2) }}
	<hr>
</h1>
</div>


<div class="row">
@if (count($roles))


<div class="table-responsive">
<table class="table table-striped table-hover" id="DataTable">
	<thead>
		<tr>
			<th>#</th>
			<th>{{ trans('kotoba::table.name') }}</th>
			<th>{{ trans('kotoba::table.level') }}</th>
			<th>{{ trans('kotoba::table.active') }}</th>
			<th>{{ trans('kotoba::table.actions') }}</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($roles as $role)
			<tr>
				<td>{{ $role->id }}</td>
				<td>{{ $role->name() }}</td>
				<td>{{ $role->slug }}</td>
				<td>{{ $role->description }}</td>
				<td width="20%">
					{!! Form::open(array(
						'route' => array('roles.destroy', $role->id),
						'role' => 'form',
						'method' => 'delete',
						'class' => 'form-inline'
					)) !!}


					{!! Form::close() !!}
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
</div><!-- ./responsive -->


@else
	{{-- Bootstrap::info( trans('kotoba::general.no_records'), true) --}}
@endif
</div>
@stop
