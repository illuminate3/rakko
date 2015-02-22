@extends(Config::get('vedette.vedette_views.layout'))

@section('title')
@parent
	{{ Config::get('vedette.vedette_html.separator') }}
	{{ trans('lingos::hr.sites') }}
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
				'sites.create',
				trans('lingos::button.new'),
				'plus fa-fw',
				array('class' => 'btn btn-info')
			) }}
		@endif
	@endif
	{{ Bootstrap::linkIcon(
		'home',
		trans('lingos::button.back'),
		'chevron-left fa-fw',
		array('class' => 'btn btn-default')
	) }}
	</p>
	<i class="fa fa-angle-double-right fa-lg"></i>
	{{ trans('lingos::hr.sites') }}
	<hr>
</h1>
</div>

{{--
<div>
<br>
<br>
{{ Datatable::table()
	->addColumn(trans('lingos::table.name'), trans('lingos::table.division'), trans('lingos::table.website'), trans('lingos::table.supervisior'), trans('lingos::table.actions'))
	->setUrl(route('api.sites'))
	->setOptions(array(
		'dom' =>"T<'clear'>lfrtip",
		'tabletools' => array(
			"aSwfPath" => "/assets/Datatables/extensions/TableTools/swf/copy_csv_cls_pdf.swf"
		)
	))
	->render(Config::get('vedette.vedette_views.datatable'))
}}
<br>
<br>
</div>
--}}



<div class="row">
@if (count($sites))

<div class="table-responsive">
<table class="table table-striped table-hover" id="DataTable">
	<thead>
		<tr>
			<th>#</th>
			<th>{{ trans('lingos::table.name') }}</th>
			<th>{{ trans('lingos::table.division') }}</th>
			<th>{{ trans('lingos::table.website') }}</th>
			<th>{{ trans('lingos::table.supervisior') }}</th>
			<th>{{ trans('lingos::table.actions') }}</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($sites as $site)
			<tr>
				<td>{{ $site->id }}</td>
				<td>{{{ $site->name }}}</td>
				<td>{{{ $site->division->name }}}</td>
				<td>{{{ $site->website }}}</td>
				<td>{{{ $site->user->first_name }}}&nbsp;{{{ $site->user->last_name }}}</td>
				<td>

					{{ Form::open(array(
						'route' => array('sites.destroy', $site->id),
						'role' => 'form',
						'method' => 'delete',
						'class' => 'form-inline'
					)) }}

					{{ Bootstrap::linkRouteIcon(
						'sites.show',
						trans('lingos::button.view'),
						'chevron-right fa-fw',
						array($site->id),
						array(
							'class' => 'btn btn-primary form-group',
							'title' => trans('lingos::general.view')
						)
					) }}

@if (Auth::check())
@if (Auth::user()->hasRoleWithName('Admin'))

					{{ Bootstrap::linkRouteIcon(
						'sites.edit',
						trans('lingos::button.edit'),
						'edit fa-fw',
						array($site->id),
						array(
							'class' => 'btn btn-success form-group',
							'title' => trans('lingos::account.command.edit')
						)
					) }}

						{{ Bootstrap::linkRouteIcon(
							'sites.destroy',
							trans('lingos::button.delete'),
							'trash-o fa-fw',
							array($site->id),
							array(
								'class' => 'btn btn-danger form-group action_confirm',
								'data-method' => 'delete',
								'title' => trans('lingos::account.command.delete')
							)
						) }}

@endif
@endif

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
