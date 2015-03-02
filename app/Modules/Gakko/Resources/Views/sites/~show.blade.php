@extends(Config::get('vedette.vedette_views.layout'))

@section('title')
@parent
	{{ Config::get('vedette.vedette_html.separator') }}
	{{ trans('lingos::hr.site') }}
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
		'sites.index',
		trans('lingos::button.back'),
		'chevron-left fa-fw',
		array('class' => 'btn btn-default')
	) }}
	</p>
	<i class="fa fa-university fa-lg"></i>
	{{ $site->name }}
	<hr>
</h1>
</div>

<div class="row">

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			{{ trans('lingos::general.information') }}
		</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-4">
				<strong>
					{{ trans('lingos::account.address') }}:
				</strong>
				<br>
				{{{ $site->address }}}
				<br>
				{{{ $site->city }}}, {{{ $site->state }}}&nbsp;&nbsp;&nbsp;{{{ $site->zipcode }}}
				<br>
				<br>
				<strong>
					{{ trans('lingos::account.website') }}:
				</strong>
				<br>
				{{{ $site->website }}}


				<br>
				<br>
				<strong>
					{{ trans('lingos::account.primary_phone') }}:
				</strong>
				<br>
				{{{ $site->primary_phone }}}


				<br>
				<br>
				<strong>
					{{ trans('lingos::account.secondary_phone') }}:
				</strong>
				<br>
				{{{ $site->secondary_phone }}}


			</div>
			<div class="col-md-4">
				<strong>
					{{ trans('lingos::general.contact') }}:
				</strong>
				<br>
				{{{ $contact->last_name }}},&nbsp;{{{ $contact->first_name }}}


				<br>
				<br>
				<strong>
					{{ trans('lingos::hr.division') }}:
				</strong>
				<br>
				{{{ $site->division->name }}}


				<br>
				<br>
				<strong>
					{{ trans('lingos::account.email') }}:
				</strong>
				<br>
				{{{ $site->email }}}


			</div>
			<div class="col-md-4">
				{{-- $site->logo --}}
				@if($logo)
					<img src="{{ Request::root() . $logo['thumb'] }}" class="logo">
				@else
					{{ trans('lingos::account.error.logo') }}
				@endif
			</div>
		</div>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			{{ trans('lingos::general.introduction') }}
		</h3>
	</div>
	<div class="panel-body">
		{{{ $site->notes }}}
	</div>
</div>

@if (Auth::check())
@if (Auth::user()->hasRoleWithName('Admin'))

<div class="pull-right">
	{{ Form::open(array(
		'route' => array('sites.destroy', $site->id),
		'role' => 'form',
		'method' => 'DELETE',
		'class' => 'form-inline'
	)) }}

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

	{{ Form::close() }}
</div>

@endif
@endif

<br class="clearfix">
<br>

</div>


@if ($profiles->count())

<h3>
	{{ trans('lingos::general.staff') }}
</h3>

<div class="table-responsive">
<table class="table table-striped table-hover" id="DataTable">
	<thead>
		<tr>
			<th>{{ trans('lingos::table.name') }}</th>
			<th>{{ trans('lingos::table.email') }}</th>
			<th>{{ trans('lingos::table.job_title') }}</th>
{{--
			<th>{{ trans('lingos::table.subject') }}</th>
--}}
			<th>{{ trans('lingos::table.actions') }}</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($profiles as $profile)
			<tr>
				<td>
					{{{ $profile->first_name }}}
					{{{ $profile->middle_initial }}}
					{{{ $profile->last_name }}}
					{{{ $profile->suffix }}}
				</td>
				<td>{{{ $profile->email }}}</td>
				<td>
				{{-- $profile->position->name --}}
				{{ $profile->present()->jobtitles($profile->job_title_id) }}
				{{-- $profile->present()->jobtitles() --}}
				</td>
{{--
				<td>{{{ $profile->subject->name }}}</td>
--}}
				<td width="25%">
					{{ Form::open(array(
						'route' => array('profiles.destroy', $profile->id),
						'role' => 'form',
						'method' => 'DELETE',
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

@else
	{{ Bootstrap::info( trans('lingos::general.no_records'), true) }}
@endif

@stop
