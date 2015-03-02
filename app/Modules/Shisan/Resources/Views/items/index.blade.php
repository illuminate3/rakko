@extends(Config::get('vedette.vedette_views.layout'))

@section('title')
@parent
	{{ Config::get('vedette.vedette_html.separator') }}
	Items
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
			{{ Bootstrap::linkIcon(
				'items.create',
				trans('lingos::button.new'),
				'plus fa-fw',
				array('class' => 'btn btn-info')
			) }}
	{{ Bootstrap::linkIcon(
		'items.index',
		trans('lingos::button.back'),
		'chevron-left fa-fw',
		array('class' => 'btn btn-default')
	) }}
	</p>
	<i class="fa fa-angle-double-right fa-lg"></i>
	Items
	<hr>
</h1>
</div>


<div class="row">
@if (count($items))
{{--
<div class="table-responsive">
<table class="table table-striped table-hover" id="DataTable">
	<thead>
		<tr>
			<th>Make</th>
			<th>Model</th>
			<th>Model Number</th>
			<th>Category</th>
			<th>Description</th>
			<th>Image</th>
			<th>{{ trans('lingos::table.actions') }}</th>
		</tr>
	</thead>

	<tbody>

		@foreach ($items as $item)
			<tr>
				<td>{{{ $item->make }}}</td>
				<td>{{{ $item->model }}}</td>
				<td>{{{ $item->model_number }}}</td>
				<td>{{{ $item->present()->categoryName($item->category_id) }}}</td>
				<td>{{{ $item->description }}}</td>
				<td>{{{ $item->image }}}</td>

				<td width="25%">
					{{ Form::open(array(
						'route' => array('items.destroy', $item->id),
						'role' => 'form',
						'method' => 'delete',
						'class' => 'form-inline'
					)) }}

						{{ Bootstrap::linkRouteIcon(
							'items.show',
							trans('lingos::button.view'),
							'chevron-right fa-fw',
							array($item->id),
							array(
								'class' => 'btn btn-primary form-group',
								'title' => trans('lingos::general.view')
							)
						) }}

						{{ Bootstrap::linkRouteIcon(
							'items.edit',
							trans('lingos::button.edit'),
							'edit fa-fw',
							array($item->id),
							array(
								'class' => 'btn btn-success form-group',
								'title' => trans('lingos::account.command.edit')
							)
						) }}

						{{ Bootstrap::linkRouteIcon(
							'items.destroy',
							trans('lingos::button.delete'),
							'trash-o fa-fw',
							array($item->id),
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
--}}

	{{ Datatable::table()
		->addColumn(
			'id',
			'Make',
			'Model',
			'Model Number',
			'Category',
			'Description',
			'Image',
			trans('lingos::table.actions')
		)
		->setUrl(route('api.items'))
		->setOptions(array(
			'dom' =>"T<'clear'>lfrtip",
			'tabletools' => array(
				"aSwfPath" => "/assets/Datatables/extensions/TableTools/swf/copy_csv_cls_pdf.swf"
			)
		))
		->render(Config::get('vedette.vedette_views.datatable'))
	}}

@else
	{{ Bootstrap::info( trans('lingos::general.no_records'), true) }}
@endif

</div>

@stop
