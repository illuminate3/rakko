@extends(Config::get('vedette.vedette_views.layout'))

@section('title')
@parent
	{{ Config::get('vedette.vedette_html.separator') }}
	{{ trans('lingos::general.staff') }}
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

			@if ( Config::get('vedette.vedette_settings.add_profile') == True )
				{{ Bootstrap::linkIcon(
					'users.create',
					trans('lingos::button.new'),
					'plus fa-fw',
					array('class' => 'btn btn-info')
				) }}
			@else
				{{ Bootstrap::linkIcon(
					'profiles.create',
					trans('lingos::button.new'),
					'plus fa-fw',
					array('class' => 'btn btn-info')
				) }}
			@endif

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
	{{ trans('lingos::general.staff') }}
	<hr>
</h1>
</div>


<div>
<br>
<br>
{{ Datatable::table()
	->addColumn(trans('lingos::table.first_name'), trans('lingos::table.last_name'), trans('lingos::table.email'), trans('lingos::table.job_title'), trans('lingos::table.site'), trans('lingos::table.actions'))
	->setUrl(route('api.profiles'))
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



<div class="row">
@if ($profiles->count())

{{--
<div class="table-responsive">
	<table class="table table-striped table-hover" id="DataTable">
		<thead>
			<tr>
				<th>{{ trans('lingos::table.name') }}</th>
				<th>{{ trans('lingos::table.email') }}</th>
				<th>{{ trans('lingos::table.position') }}</th>
				<th>{{ trans('lingos::table.site') }}</th>
				<th>{{ trans('lingos::table.actions') }}</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($profiles as $profile)
				<tr>
					<td>
						{{{ $profile->prefix }}}
						{{{ $profile->first_name }}}
						{{{ $profile->middle_initial }}}
						{{{ $profile->last_name }}}
						{{{ $profile->suffix }}}
					</td>
					<td>{{{ $profile->email }}}</td>
					<td>
@if ( isset($profile->position->name ) )
						{{{ $profile->position->name }}}
@endif
					</td>
					<td>
@if ( isset($profile->site->name ) )
						{{{ $profile->site->name }}}
@endif

					</td>
				<td width="25%">

					{{ Form::open(array(
						'route' => array('profiles.destroy', $profile->id),
						'role' => 'form',
						'method' => 'delete',
						'class' => 'form-inline'
					)) }}

					{{ Bootstrap::linkRouteIcon(
						'profiles.show',
						trans('lingos::button.view'),
						'chevron-right fa-fw',
						array($profile->id),
						array(
							'class' => 'btn btn-primary form-group',
							'title' => trans('lingos::general.view')
						)
					) }}

@if (Auth::check())
@if (Auth::user()->hasRoleWithName('Admin'))

					{{ Bootstrap::linkRouteIcon(
						'profiles.edit',
						trans('lingos::button.edit'),
						'edit fa-fw',
						array($profile->id),
						array(
							'class' => 'btn btn-success form-group',
							'title' => trans('lingos::account.command.edit')
						)
					) }}

						{{ Bootstrap::linkRouteIcon(
							'profiles.destroy',
							trans('lingos::button.delete'),
							'trash-o fa-fw',
							array($profile->id),
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
</div> <!-- ./responsive -->
--}}
@else
	{{ Bootstrap::info( trans('lingos::general.no_records'), true) }}
@endif
</div>

{{--
<div class="row">
	<div class="col-md-12">
	<h3>Users</h3>
	{{ $table->render() }}
	{{ $table->script() }}
	</div>
</div>
--}}
@stop
