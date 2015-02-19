@extends(Config::get('vedette.vedette_views.layout'))

@section('title')
@parent
	{{ Config::get('vedette.vedette_html.separator') }}
	{{ trans('lingos::account.profile') }}
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
		'profiles.index',
		trans('lingos::button.back'),
		'chevron-left fa-fw',
		array('class' => 'btn btn-default')
	) }}


@if (Auth::check())
@if ( (Auth::user()->id == $profile->id ) || (Auth::user()->hasRoleWithName('Admin')) )
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

@endif
@endif

	</p>
	<i class="fa fa-user fa-lg"></i>
	{{{ $profile->prefix }}}&nbsp;{{{ $profile->first_name }}}&nbsp;{{{ $profile->middle_initial }}}&nbsp;{{{ $profile->last_name }}}&nbsp;{{{ $profile->suffix }}}
	<hr>
</h1>
</div>

<div class="row">

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			{{ trans('lingos::hr.employment_information') }}:
		</h3>
	</div>
	<div class="panel-body">
		<div class="row">
@if ( $_ENV['APP_TYPE'] == 'HR' )
			<div class="col-xs-12 col-md-8">
				<strong>
					{{ trans('lingos::hr.department') }}:
				</strong>
				<br>
{{-- dd($departments) --}}
				{{{ $profile->present()->departments() }}}
				<br>
				<br>
				<strong>
					{{ trans('lingos::hr.position') }}:
				</strong>
				<br>
{{-- dd($positions) --}}

@if ( isset($profile->position_id ) )
				{{-- $profile->present()->positions($profile->position_id) --}}
				{{{ $profile->position->name }}}
@endif


				<br>
				<br>
				<strong>
					{{ trans('lingos::hr.job_title') }}:
				</strong>
				<br>
@if ( isset($profile->jobTitle->name ) )
				{{{ $profile->jobTitle->name }}}
@endif
				<br>
				<br>
				<strong>
					{{ trans('lingos::hr.employee_type') }}:
				</strong>
				<br>
@if ( isset($profile->employee_type->name ) )
				{{{ $profile->employee_type->name }}}
@endif
				<br>
				<br>
				<strong>
					{{ trans('lingos::general.contact') }}:
				</strong>
				<br>
				{{-- $profile->supervisor_id --}}
@if ( isset($profile->supervisor) )
				{{{ $supervisor->prefix }}}&nbsp;{{{ $supervisor->first_name }}}&nbsp;{{{ $supervisor->middle_initial }}}&nbsp;{{{ $supervisor->last_name }}}&nbsp;{{{ $supervisor->suffix }}}
@endif
			</div>
@endif
			<div class="col-xs-6 col-md-4">
				{{-- $site->picture --}}
				@if($picture)
					<img src="{{ $picture }}" class="img-circle profile">

{{--
					<img src="{{ Request::root() . $picture['thumb'] }}" class="img-circle profile">


				@if ( isset($picture['thumb']) )
					<img
						src="{{ asset('/uploads/logos/'. $profile->picture) }}"
						alt="{{ Auth::user()->email }}"
						class="img-circle profile"
					/>

					<img src="{{ Request::root() . $picture['thumb'] }}" class="logo">
				@elseif  ( isset($picture) )
					<img src="{{ $picture }}" class="logo">
--}}
				@else
					{{ trans('lingos::account.error.logo') }}
				@endif
			</div>
		</div>
	</div>
	<div class="panel-body">
		<strong>
			{{ trans('lingos::general.introduction') }}:
		</strong>
		<br>
		{{{ $profile->notes }}}
	</div>
</div>

@if ( $_ENV['APP_TYPE'] == 'HR' )
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			{{ trans('lingos::hr.job_information') }}:
		</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<strong>
					{{ trans('lingos::hr.site') }}:
				</strong>
				<br>
				{{ $profile->present()->sitesShow() }}
@if ( $profile->present()->grades() )
				<br>
				<br>
				<strong>
					{{ trans('lingos::hr.grades') }}:
				</strong>
				<br>
				{{ $profile->present()->grades() }}
@endif
@if ( $profile->present()->subjects() )
				<br>
				<br>
				<strong>
					{{ trans('lingos::hr.subjects') }}:
				</strong>
				<br>
				@if ( isset($profile->subject->name ) )
					{{{ $profile->subject->name }}}
					{{ $profile->present()->subjects() }}
				@endif
				{{ $profile->present()->subjects() }}
@endif


			</div>
{{--
			<div class="col-md-6">
				<strong>
					{{ trans('lingos::account.primary_email') }}:
				</strong>
				<br>
				{{{ $profile->email }}}
				<br>
				<br>
				<strong>
					{{ trans('lingos::account.secondary_email') }}:
				</strong>
				<br>
				{{{ $profile->secondary_email }}}
			</div>
--}}

		</div>
	</div>
</div>
@endif


<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			{{ trans('lingos::hr.contact_information') }}:
		</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6">
				<strong>
					{{ trans('lingos::account.primary_phone') }}:
				</strong>
				<br>
				{{{ $profile->primary_phone }}}
				<br>
				<br>
				<strong>
					{{ trans('lingos::account.secondary_phone') }}:
				</strong>
				<br>
				{{{ $profile->secondary_phone }}}
				<br>
				<br>
				<strong>
					{{ trans('lingos::account.address') }}:
				</strong>
				<br>
				{{{ $profile->address }}}
				<br>
@if ( !empty($profile->city ) )
				{{{ $profile->city }}},&nbsp;
@endif
				{{{ $profile->state }}}&nbsp;&nbsp;&nbsp;{{{ $profile->zipcode }}}
			</div>
			<div class="col-md-6">
				<strong>
					{{ trans('lingos::account.primary_email') }}:
				</strong>
				<br>
				{{{ $profile->email }}}
				<br>
				<br>
				<strong>
					{{ trans('lingos::account.secondary_email') }}:
				</strong>
				<br>
				{{{ $profile->secondary_email }}}
			</div>
		</div>
	</div>
</div>

@stop
