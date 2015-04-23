@extends('app')

{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::account.profile', 2) }} :: @parent
@stop

@section('styles')
@stop

@section('scripts')
@stop

@section('inline-scripts')
@stop


{{-- Content --}}
@section('content')

<div class="row">
<h1>
	<p class="pull-right">
	<a href="/profiles" class="btn btn-default" title="{{ trans('kotoba::button.back') }}">
		<i class="fa fa-chevron-left fa-fw"></i>
		{{ trans('kotoba::button.back') }}
	</a>
	</p>
	<i class="fa fa-user fa-lg"></i>
	@if ( !empty($profile->prefix ) )
		{{{ $profile->prefix }}}&nbsp;
	@endif
	@if ( !empty($profile->first_name ) )
		{{{ $profile->first_name }}}
	@endif
	@if ( !empty($profile->middle_initial ) )
		&nbsp;{{{ $profile->middle_initial }}}
	@endif
	@if ( !empty($profile->last_name ) )
		&nbsp;{{{ $profile->last_name }}}
	@endif
	@if ( !empty($profile->prefix ) )
		&nbsp;{{{ $profile->prefix }}}
	@endif
	@if ( !empty($profile->suffix ) )
		&nbsp;{{{ $profile->suffix }}}
	@endif
	<hr>
</h1>
</div>


<div class="row">

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			{{ trans('kotoba::general.information') }}:
		</h3>
	</div><!-- ./panel-heading -->
	<div class="panel-body">
	<div class="row">
		<div class="col-md-8">

			<div class="col-md-8">
				<strong>
					{{ trans('kotoba::account.primary_phone') }}:
				</strong>
				<br>
				@if ( !empty($profile->primary_phone ) )
					{{{ $profile->primary_phone }}}
				@endif
				<br>
				<br>
				<strong>
					{{ trans('kotoba::account.secondary_phone') }}:
				</strong>
				<br>
				@if ( !empty($profile->secondary_phone ) )
					{{{ $profile->secondary_phone }}}
				@endif
				<br>
				<br>
				<strong>
					{{ trans('kotoba::account.address') }}:
				</strong>
				<br>
				@if ( !empty($profile->address ) )
					{{{ $profile->address }}}
				@endif
				<br>
				@if ( !empty($profile->city ) )
					{{{ $profile->city }}}
				@endif
				@if ( !empty($profile->state ) )
					,&nbsp;{{{ $profile->state }}}
				@endif
				@if ( !empty($profile->zipcode ) )
					&nbsp;&nbsp;&nbsp;{{{ $profile->zipcode }}}
				@endif
			</div>
			<div class="col-md-4">
				<strong>
					{{ trans('kotoba::account.primary_email') }}:
				</strong>
				<br>
				@if ( !empty($profile->email ) )
					{{{ $profile->email }}}
				@endif
				@if ( !empty($profile->email ) )
					{{{ $profile->user->email }}}
				@endif
				<br>
				<br>
				<strong>
					{{ trans('kotoba::account.secondary_email') }}:
				</strong>
				<br>
				@if ( !empty($profile->secondary_email ) )
					{{{ $profile->secondary_email }}}
				@endif
			</div>
		</div>
		<div class="col-md-4">
				@if ( !empty($profile->user->avatar ) )
					<img
						src="{{ asset($profile->user->avatar) }}"
						alt="{{ $profile->email_1 }}"
						class="img-thumbnail profile"
					/>
				@else
					<img
						src="{{ asset('/assets/images/usr.png') }}"
						class="img-thumbnail profile"
					/>
					{{-- trans('kotoba::account.error.logo') --}}
				@endif
		</div>
	</div><!-- ./row -->
	</div><!-- ./panel-body -->
	<div class="panel-body">
		<strong>
			{{ trans('kotoba::general.introduction') }}:
		</strong>
		<br>
		@if ( !empty($profile->notes ) )
			{{{ $profile->user->notes }}}
		@endif
		<br>
	</div><!-- ./panel-body -->
</div><!-- ./panel -->


<hr>


<div class="row">
@if (Auth::user()->can('manage_profiles'))
	<div class="col-sm-4">
		<a href="/profiles" class="btn btn-default btn-block" title="{{ trans('kotoba::button.back') }}">
			<i class="fa fa-chevron-left fa-fw"></i>
			{{ trans('kotoba::button.back') }}
		</a>
	</div>

	<div class="col-sm-4">
		<a href="/profiles/{{ $profile->id }}/edit" class="btn btn-default btn-block" title="{{ trans('kotoba::button.edit') }}">
			<i class="fa fa-pencil fa-fw"></i>
			{{ trans('kotoba::button.edit') }}
		</a>
	</div>

	<div class="col-sm-4">
<!-- Button trigger modal -->
		<a data-toggle="modal" data-target="#myModal" class="btn btn-default btn-block" title="{{ trans('kotoba::button.delete') }}">
			<i class="fa fa-trash-o fa-fw"></i>
			{{ trans('kotoba::general.command.delete') }}
		</a>
	</div>
@elseif (Auth::user()->can('manage_own'))
	<div class="col-sm-6">
		<a href="/profiles" class="btn btn-default btn-block" title="{{ trans('kotoba::button.back') }}">
			<i class="fa fa-chevron-left fa-fw"></i>
			{{ trans('kotoba::button.back') }}
		</a>
	</div>

	<div class="col-sm-6">
		<a href="/profiles/{{ $profile->id }}/edit" class="btn btn-default btn-block" title="{{ trans('kotoba::button.edit') }}">
			<i class="fa fa-pencil fa-fw"></i>
			{{ trans('kotoba::button.edit') }}
		</a>
	</div>
@else
	<div class="col-sm-12">
		<a href="/profiles" class="btn btn-default btn-block" title="{{ trans('kotoba::button.back') }}">
			<i class="fa fa-chevron-left fa-fw"></i>
			{{ trans('kotoba::button.back') }}
		</a>
	</div>
@endif
</div>


</div> <!-- ./ row -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	@include('_partials.modal')
</div>


@stop
