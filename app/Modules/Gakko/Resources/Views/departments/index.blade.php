@extends(Config::get('vedette.vedette_views.layout'))

@section('title')
@parent
	{{ Config::get('vedette.vedette_html.separator') }}
	{{ trans('lingos::hr.departments') }}
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
				'admin.departments.create',
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
	{{ trans('lingos::hr.departments') }}
	<hr>
</h1>
</div>

<div class="row">
@if (count($departments))

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
		@foreach ($departments as $department)
			<tr>
				<td>{{ $department->id }}</td>
				<td>{{{ $department->name }}}</td>
				<td>{{{ $department->description }}}</td>
				<td width="25%">
					{{ Form::open(array(
						'route' => array('admin.departments.destroy', $department->id),
						'role' => 'form',
						'method' => 'delete',
						'class' => 'form-inline'
					)) }}

						{{ Bootstrap::linkRouteIcon(
							'admin.departments.show',
							trans('lingos::button.view'),
							'chevron-right fa-fw',
							array($department->id),
							array(
								'class' => 'btn btn-primary form-group',
								'title' => trans('lingos::general.view')
							)
						) }}

						{{ Bootstrap::linkRouteIcon(
							'admin.departments.edit',
							trans('lingos::button.edit'),
							'edit fa-fw',
							array($department->id),
							array(
								'class' => 'btn btn-success form-group',
								'title' => trans('lingos::account.command.edit')
							)
						) }}

						{{ Bootstrap::linkRouteIcon(
							'admin.departments.destroy',
							trans('lingos::button.delete'),
							'trash-o fa-fw',
							array($department->id),
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
