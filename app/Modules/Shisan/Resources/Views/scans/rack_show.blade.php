@extends(Config::get('vedette.vedette_views.layout'))

@section('title')
@parent
	{{ Config::get('vedette.vedette_html.separator') }}
: Alert
@stop

@section('scripts')
	<script src="{{ asset('packages/illuminate3/vedette/assets/js/restfulizer.js') }}"></script>
@stop

@section('styles')
@stop

@section('inline-scripts')
	var text_confirm_message = '{{ trans('lingos::general.ask.delete') }}';
@stop

@section('content')

<h1>
{{--
	<p class="pull-right">
		<a href="{{{ URL::to('scans/index') }}}" class="btn btn-primary btn-block">Scans</a>
	</p>
--}}
	<i class="fa fa-tag fa-lg"></i>
	Rack Information
	<hr>
</h1>


<div class="panel panel-default">
	<div class="panel-heading">
		<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6">
				<h1>
					Rack #
					{{{ $rack->zone . '-' . $rack->aisle . '-' . $rack->level . '-' . $rack->slot }}}
				</h1>
			</div>
			<div class="col-sm-6">
				<h1>
					Bar Code :
					{{{ $rack->barcode }}}
				</h1>
			</div>
		</div>
		</div>
	</div>
	<div class="panel-body">


@if ($rack->pallet)

<div class="alert alert-danger">
	Pallet in Rack !
</div>

<div class="table-responsive">
<table class="table table-striped table-bordered">
<tbody>
	<tr>
		<td>
			PO # :
		</td>
		<td>{{{ $rack->pallet->purchase_order_no }}}</td>
	</tr>
	<tr>
		<td>
			Item :
		</td>
		<td>
			{{{ $rack->pallet->present()->number($rack->pallet->catalog_id) }}}
				&nbsp;:&nbsp;
			{{{ $rack->pallet->present()->item($rack->pallet->catalog_id) }}}
		</td>
	</tr>
	<tr>
		<td>
			Quantity :
		</td>
		<td>{{{ $rack->pallet->level }}}</td>
	</tr>
	<tr>
		<td>
			Pallet Bar Code :
		</td>
		<td>{{{ $rack->pallet->barcode }}}</td>
	</tr>
	<tr>
		<td>
			Pack Date :
		</td>
		<td>{{{ $rack->pallet->pack_date }}}</td>
	</tr>
	<tr>
		<td>
			Sale by Date :
		</td>
		<td>{{{ $rack->pallet->sell_by_date }}}</td>
	</tr>
	<tr>
		<td>
			Received Date :
		</td>
		<td>{{{ $rack->pallet->date_received }}}</td>
	</tr>
</tbody>
</table>
</div> <!-- ./responsive -->


<div class="row">
	<div class="col-sm-4">
		{{ Bootstrap::linkIcon(
			'scans.index',
			'Return to Scans',
			'chevron-left fa-fw',
			[
				'class' => 'btn btn-primary btn-block'
			]
		) }}
	</div>
	<div class="col-sm-4">
		{{ Bootstrap::linkRouteIcon(
			'moves.edit',
			'Move to Rack',
			'indent fa-fw',
			array($rack->pallet->id),
			[
				'class' => 'btn btn-success btn-block'
			]
		) }}
		{{-- link_to_route('moves.edit', 'Move to Rack', array($pallet->id), array('class' => 'btn btn-success btn-block')) --}}
	</div>
	<div class="col-sm-4">
		{{ Bootstrap::linkRouteIcon(
			'move_pallets.edit',
			'Move to Zone',
			'th fa-fw',
			array($rack->pallet->id),
			[
				'class' => 'btn btn-info btn-block'
			]
		) }}
		{{-- link_to_route('move_pallets.edit', 'Move to Zone', array($pallet->id), array('class' => 'btn btn-info btn-block')) --}}
	</div>
</div>

<br>

{{ Form::open(array(
	'route' => array('moves.destroy', $rack->id),
	'role' => 'form',
	'method' => 'delete',
	'class' => 'form-inline'
)) }}
{{ Form::hidden('pallet_id', $rack->pallet->id) }}


	{{ Bootstrap::linkRouteIcon(
		'moves.destroy',
		'Clear Rack',
		'trash-o fa-fw',
		array($rack->id),
		array(
			'class' => 'btn btn-danger form-group btn-block action_confirm',
			'data-method' => 'delete',
			'title' => trans('lingos::account.command.delete')
		)
	) }}

{{ Form::close() }}


@else
	<br>
	<div class="alert alert-info">
		This Slot is OPEN
	</div>

		{{ Bootstrap::linkIcon(
			'scans.index',
			'Return to Scans',
			'chevron-left fa-fw',
			[
				'class' => 'btn btn-primary btn-block'
			]
		) }}

@endif



	</div>
</div>
@stop
