@extends(Config::get('vedette.vedette_views.layout'))

@section('title')
@parent
	{{ Config::get('vedette.vedette_html.separator') }}
	Assets
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
				'asset.create',
				trans('lingos::button.new'),
				'plus fa-fw',
				array('class' => 'btn btn-info')
			) }}
	{{ Bootstrap::linkIcon(
		'asset.index',
		trans('lingos::button.back'),
		'chevron-left fa-fw',
		array('class' => 'btn btn-default')
	) }}
	</p>
	<i class="fa fa-angle-double-right fa-lg"></i>
	Assets
	<hr>
</h1>
</div>

<div class="row">
@if (count($assets))
{{--
<div class="table-responsive">
<table class="table table-striped table-hover" id="DataTable">
	<thead>
		<tr>
			<th>Item_id</th>
			<th>Site_id</th>
			<th>Room</th>
			<th>Asset Status</th>
			<th>Asset_tag</th>
			<th>Serial</th>
			<th>Po</th>
			<th>Note</th>
			<th>{{ trans('lingos::table.actions') }}</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($assets as $asset)
		<tr>
			<td>{{{ $asset->item_id }}}</td>
			<td>{{{ $asset->site_id }}}</td>
			<td>{{{ $asset->room_id }}}</td>
			<td>{{{ $asset->asset_status_id }}}</td>
			<td>{{{ $asset->asset_tag }}}</td>
			<td>{{{ $asset->serial }}}</td>
			<td>{{{ $asset->po }}}</td>
			<td>{{{ $asset->note }}}</td>
			<td width="25%">

				{{ Form::open(array(
					'route' => array('asset.destroy', $asset->id),
					'role' => 'form',
					'method' => 'delete',
					'class' => 'form-inline'
				)) }}

					{{ Bootstrap::linkRouteIcon(
						'asset.show',
						trans('lingos::button.view'),
						'chevron-right fa-fw',
						array($asset->id),
						array(
							'class' => 'btn btn-primary form-group',
							'title' => trans('lingos::general.view')
						)
					) }}

					{{ Bootstrap::linkRouteIcon(
						'asset.edit',
						trans('lingos::button.edit'),
						'edit fa-fw',
						array($asset->id),
						array(
							'class' => 'btn btn-success form-group',
							'title' => trans('lingos::account.command.edit')
						)
					) }}

					{{ Bootstrap::linkRouteIcon(
						'asset.destroy',
						trans('lingos::button.delete'),
						'trash-o fa-fw',
						array($asset->id),
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
			'user_id',
			'Item_id',
			'Site_id',
			'Room',
			'Asset Status',
			'Asset_tag',
			'Serial',
			'Po',
			'barcode',
			'Note',
			trans('lingos::table.actions')
		)
		->setUrl(route('api.asset'))
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
