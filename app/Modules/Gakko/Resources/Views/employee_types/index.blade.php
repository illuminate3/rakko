@extends(Config::get('vedette.vedette_views.layout'))

@section('title')
@parent
	{{ Config::get('vedette.vedette_html.separator') }}
	{{ trans('lingos::hr.employee_types') }}
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

var text_confirm_message = '{{ trans('lingos::general.ask.delete') }}';

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
	@if (Auth::check())
		@if (Auth::user()->hasRoleWithName('Admin'))
			{{ Bootstrap::linkIcon(
				'admin.employee_types.create',
				trans('lingos::button.new'),
				'plus fa-fw',
				array('class' => 'btn btn-info')
			) }}
		@endif
	@endif
	{{ Bootstrap::linkIcon(
		'admin.index',
		trans('lingos::button.back'),
		'chevron-left fa-fw',
		array('class' => 'btn btn-default')
	) }}
	</p>
	<i class="fa fa-angle-double-right fa-lg"></i>
	{{ trans('lingos::hr.employee_types') }}
	<hr>
</h1>
</div>

<div class="row">
@if (count($employee_types))

<div class="table-responsive">
<table class="table table-striped table-hover" id="DataTable">
	<thead>
		<tr>
			<th>#</th>
			<th>{{ trans('lingos::table.name') }}</th>
			<th>{{ trans('lingos::table.description') }}</th>
			<th>{{ trans('lingos::table.actions') }}</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($employee_types as $employee_type)
			<tr>
				<td>{{ $employee_type->id }}</td>
				<td>{{{ $employee_type->name }}}</td>
				<td>{{{ $employee_type->description }}}</td>
				<td width="25%">
					{{ Form::open(array(
						'route' => array('admin.employee_types.destroy', $employee_type->id),
						'role' => 'form',
						'method' => 'delete',
						'class' => 'form-inline'
					)) }}

						{{ Bootstrap::linkRouteIcon(
							'admin.employee_types.show',
							trans('lingos::button.view'),
							'chevron-right fa-fw',
							array($employee_type->id),
							array(
								'class' => 'btn btn-primary form-group',
								'title' => trans('lingos::general.view')
							)
						) }}

						{{ Bootstrap::linkRouteIcon(
							'admin.employee_types.edit',
							trans('lingos::button.edit'),
							'edit fa-fw',
							array($employee_type->id),
							array(
								'class' => 'btn btn-success form-group',
								'title' => trans('lingos::account.command.edit')
							)
						) }}

						{{ Bootstrap::linkRouteIcon(
							'admin.employee_types.destroy',
							trans('lingos::button.delete'),
							'trash-o fa-fw',
							array($employee_type->id),
							array(
								'class' => 'btn btn-danger form-group action_confirm',
								'data-method' => 'delete',
								'title' => trans('lingos::account.command.delete')
							)
						) }}

					{{ Form::close() }}
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
</div><!-- ./responsive -->

@else
	{{ Bootstrap::info( trans('lingos::general.no_records'), true) }}
@endif

</div>

@stop
