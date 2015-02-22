@extends(Config::get('vedette.vedette_views.layout'))

@section('title')
@parent
	{{ Config::get('vedette.vedette_html.separator') }}
	{{ trans('lingos::hr.position') }}
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
		'admin.positions.index',
		trans('lingos::button.back'),
		'chevron-left fa-fw',
		array('class' => 'btn btn-default')
	) }}
	</p>
	<i class="fa fa-tag fa-lg"></i>
	{{ $position->name }}
	<hr>
</h1>
</div>

<div class="row">

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
		<tr>
			<td>{{ $position->id }}</td>
			<td>{{{ $position->name }}}</td>
			<td>{{{ $position->description }}}</td>
			<td width="25%">
				{{ Form::open(array(
					'route' => array('admin.positions.destroy', $position->id),
					'role' => 'form',
					'method' => 'delete',
					'class' => 'form-inline'
				)) }}

					{{ Bootstrap::linkRouteIcon(
						'admin.positions.edit',
						trans('lingos::button.edit'),
						'edit fa-fw',
						array($position->id),
						array(
							'class' => 'btn btn-success form-group',
							'title' => trans('lingos::account.command.edit')
						)
					) }}

					{{ Bootstrap::linkRouteIcon(
						'admin.positions.destroy',
						trans('lingos::button.delete'),
						'trash-o fa-fw',
						array($position->id),
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

@stop
