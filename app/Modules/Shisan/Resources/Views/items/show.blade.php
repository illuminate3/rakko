@extends(Config::get('vedette.vedette_views.layout'))

@section('title')
@parent
	{{ Config::get('vedette.vedette_html.separator') }}
	Item
@stop

@section('styles')
@stop

@section('scripts')
	<script src="{{ asset('packages/illuminate3/vedette/assets/js/restfulizer.js') }}"></script>
@stop

@section('inline-scripts')

var text_confirm_message = '{{ trans('lingos::general.ask.delete') }}';

@stop

@section('content')
<div class="row">
<h1>
	<p class="pull-right">
	{{ Bootstrap::linkIcon(
		'items.index',
		trans('lingos::button.back'),
		'chevron-left fa-fw',
		array('class' => 'btn btn-default')
	) }}
	</p>
	<i class="fa fa-tag fa-lg"></i>
	Item
	<hr>
</h1>
</div>

<div class="row">

<div class="table-responsive">
<table class="table table-striped table-hover" id="DataTable">
	<thead>
		<tr>

			<th>Make</th>
			<th>Model</th>
			<th>Model Number</th>
			<th>Description</th>
			<th>Image</th>

			<th>{{ trans('lingos::table.actions') }}</th>
		</tr>
	</thead>

	<tbody>
		<tr>

			<td>{{{ $item->make }}}</td>
			<td>{{{ $item->model }}}</td>
			<td>{{{ $item->model_number }}}</td>
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
	</tbody>
</table>
</div><!-- ./responsive -->

</div>


@if ($assets != NULL)

<h3>
	Assets
</h3>

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
			<td>{{{ $asset->room }}}</td>
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
</div> <!-- ./responsive -->

@else
	{{ Bootstrap::info( trans('lingos::general.no_records'), true) }}
@endif



@stop
