@extends(Config::get('vedette.vedette_views.layout'))

@section('title')
@parent
	{{ Config::get('vedette.vedette_html.separator') }}
: Alert
@stop

@section('scripts')
@stop

@section('styles')
@stop

@section('inline-scripts')
@stop


@section('content')

<h1>
{{--
	<p class="pull-right">
		<a href="{{{ URL::to('scans/index') }}}" class="btn btn-primary btn-block">Scans</a>
	</p>
	{{{ $pallet->id }}}
--}}
	<i class="fa fa-tag fa-lg"></i>
	{{{ $pallet->present()->number($pallet->catalog_id) }}}
	&nbsp;:&nbsp;
	{{ $pallet->present()->item($pallet->catalog_id) }}
	<hr>
</h1>


<div class="panel panel-default">
	<div class="panel-heading">
		<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6">
				<h1>
PO # {{{ $pallet->purchase_order_no }}}
				</h1>
			</div>
			<div class="col-sm-6">
				<h1>
Level : {{{ $pallet->level }}}
				</h1>
			</div>
		</div>
		</div>
	</div>
	<div class="panel-body">


<div class="table-responsive">
<table class="table table-striped table-bordered">
<tbody>
	<tr>
		<td>
			Pack Date :
		</td>
		<td>
			{{{ $pallet->pack_date }}}
		</td>
	</tr>
	<tr>
		<td>
			Sale by Date :
		</td>
		<td>
			{{{ $pallet->sell_by_date }}}
		</td>
	</tr>
	<tr>
		<td>
			Received Date :
		</td>
		<td>
			{{{ $pallet->date_received }}}
		</td>
	</tr>
	<tr>
		<td>
			Pallet Type :
		</td>
		<td>
			@if ($pallet->pallet_type)
				{{{ $pallet->pallet_type->name }}}
			@else
				---
			@endif
		</td>
	</tr>
	<tr>
		<td>
			Zone :
		</td>
		<td>
			@if ($pallet->zone_id != NULL)
				{{ $pallet->zone->name }}
			@else
				---
			@endif
		</td>
	</tr>
	<tr>
		<td>
			Rack :
		</td>
		<td>
			@if ($pallet->rack_id != NULL)
				{{ $pallet->rack->zone . '-' . $pallet->rack->aisle . '-' . $pallet->rack->level . '-' . $pallet->rack->slot }}
			@else
				---
			@endif
		</td>
	</tr>
	<tr>
		<td>
			Bar Code :
		</td>
		<td>
			{{{ $pallet->barcode }}}
		</td>
	</tr>
</tbody>
</table>
</div> <!-- ./responsive -->

	</div>
</div>


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
			array($pallet->id),
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
			array($pallet->id),
			[
				'class' => 'btn btn-info btn-block'
			]
		) }}
		{{-- link_to_route('move_pallets.edit', 'Move to Zone', array($pallet->id), array('class' => 'btn btn-info btn-block')) --}}
	</div>
</div>

@stop
