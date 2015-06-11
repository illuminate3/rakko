@extends('app')

{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::cms.menu', 2) }} :: @parent
@stop

@section('styles')
	<link href="{{ asset('assets/vendors/DataTables-1.10.5/plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">
@stop

@section('scripts')
	<script src="{{ asset('assets/vendors/DataTables-1.10.5/media/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/vendors/DataTables-1.10.5/plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
@stop

@section('inline-scripts')
$(document).ready(function() {
oTable =
	$('#table').DataTable({
	});
});
@stop



{{-- Content --}}
@section('content')

<div class="row">
<h1>
	<p class="pull-right">
	<a href="/admin/menus/create" class="btn btn-primary" title="{{ trans('kotoba::button.new') }}">
		<i class="fa fa-plus fa-fw"></i>
		{{ trans('kotoba::button.new') }}
	</a>
	</p>
	<i class="fa fa-paperclip fa-lg"></i>
		{{ Lang::choice('kotoba::cms.menu', 2) }}
	<hr>
</h1>
</div>


@if (count($menus))

<div class="row">
<table id="table" class="table table-striped table-hover">
	<thead>
		<tr>
			<th>{{ trans('kotoba::table.name') }}</th>
			<th>{{ trans('kotoba::table.title') }}</th>
			<th>{{ Lang::choice('kotoba::table.action', 2) }}</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($menus as $menu)
			<tr>
				<td>{{ $menu->name }}</td>
				<td>{{ $menu->title }}</td>
				<td>
					<a href="/admin/menus/{{ $menu->id }}/edit" class="btn btn-success" title="{{ trans('kotoba::button.edit') }}">
						<i class="fa fa-pencil fa-fw"></i>
						{{ trans('kotoba::button.edit') }}
					</a>
					<a href="/admin/menulinks/{{ $menu->id }}" class="btn btn-info" title="{{ trans('kotoba::button.edit') }}">
						<i class="fa fa-link fa-fw"></i>
						{{ Lang::choice('kotoba::button.link', 2) }}
					</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
</div>


@else
<div class="alert alert-info">
	{{ trans('kotoba::general.error.not_found') }}
</div>
@endif


</div>
@stop
