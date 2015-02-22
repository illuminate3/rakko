@extends(Config::get('vedette.vedette_views.layout'))

@section('title')
@parent
	{{ Config::get('vedette.vedette_html.separator') }}
	{{ trans('lingos::hr.division') }}
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
		'admin.divisions.index',
		trans('lingos::button.back'),
		'chevron-left fa-fw',
		array('class' => 'btn btn-default')
	) }}
	</p>
	<i class="fa fa-tag fa-lg"></i>
	{{ $division->name }}
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
			<td>{{ $division->id }}</td>
			<td>{{{ $division->name }}}</td>
			<td>{{{ $division->description }}}</td>
			<td width="25%">
				{{ Form::open(array(
					'route' => array('admin.divisions.destroy', $division->id),
					'role' => 'form',
					'method' => 'delete',
					'class' => 'form-inline'
				)) }}

					{{ Bootstrap::linkRouteIcon(
						'admin.divisions.edit',
						trans('lingos::button.edit'),
						'edit fa-fw',
						array($division->id),
						array(
							'class' => 'btn btn-success form-group',
							'title' => trans('lingos::account.command.edit')
						)
					) }}

					{{ Bootstrap::linkRouteIcon(
						'admin.divisions.destroy',
						trans('lingos::button.delete'),
						'trash-o fa-fw',
						array($division->id),
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
