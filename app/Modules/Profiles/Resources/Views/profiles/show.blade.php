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
	$(function() {
		$("#roles").select2()
	});
@stop


{{-- Content --}}
@section('content')

<div id="wrap" class="container">

<div class="row">
<h1>
	<p class="pull-right">
	<a href="/profiles" class="btn btn-default" title="{{ trans('kotoba::button.back') }}">
		<i class="fa fa-chevron-left fa-fw"></i>
		{{ trans('kotoba::button.back') }}
	</a>
	</p>
	<i class="fa fa-user fa-lg"></i>
	{{{ $profile->prefix }}}&nbsp;{{{ $profile->first_name }}}&nbsp;{{{ $profile->middle_initial }}}&nbsp;{{{ $profile->last_name }}}&nbsp;{{{ $profile->suffix }}}
	<hr>
</h1>
</div>


<div class="row">
{!! Form::model(
	$profile,
	[
		'route' => ['profiles.update', $profile->id],
		'method' => 'PATCH',
		'class' => 'form'
	]
) !!}


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
				{{{ $profile->primary_phone }}}
				<br>
				<br>
				<strong>
					{{ trans('kotoba::account.secondary_phone') }}:
				</strong>
				<br>
				{{{ $profile->secondary_phone }}}
				<br>
				<br>
				<strong>
					{{ trans('kotoba::account.address') }}:
				</strong>
				<br>
				{{{ $profile->address }}}
				<br>
@if ( !empty($profile->city ) )
				{{{ $profile->city }}},&nbsp;
@endif
				{{{ $profile->state }}}&nbsp;&nbsp;&nbsp;{{{ $profile->zipcode }}}
			</div>
			<div class="col-md-4">
				<strong>
					{{ trans('kotoba::account.primary_email') }}:
				</strong>
				<br>
				{{{ $profile->email }}}
				{{{ $profile->user->email }}}
				<br>
				<br>
				<strong>
					{{ trans('kotoba::account.secondary_email') }}:
				</strong>
				<br>
				{{{ $profile->secondary_email }}}
			</div>
		</div>
		<div class="col-md-4">
				@if($profile->avatar)
					<img src="{{ $avatar }}" class="img-rounded profile">

{{--
					<img src="{{ Request::root() . $avatar['thumb'] }}" class="img-circle profile">


				@if ( isset($picture['thumb']) )
					<img
						src="{{ asset('/uploads/logos/'. $profile->avatar) }}"
						alt="{{ Auth::user()->email }}"
						class="img-circle profile"
					/>

					<img src="{{ Request::root() . $avatar['thumb'] }}" class="logo">
				@elseif  ( isset(avatar) )
					<img src="{{ $avatar }}" class="logo">
--}}
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
		{{{ $profile->notes }}}
		<br>
	</div><!-- ./panel-body -->
</div><!-- ./panel -->


<hr>

<div class="form-group">
	<input class="btn btn-success btn-block" type="submit" value="{{ trans('kotoba::button.save') }}">
</div>

{!! Form::close() !!}


<div class="row">
<div class="col-sm-4">
	<a href="/profiles" class="btn btn-default btn-block" title="{{ trans('kotoba::button.cancel') }}">
		<i class="fa fa-times fa-fw"></i>
		{{ trans('kotoba::button.cancel') }}
	</a>
</div>

<div class="col-sm-4">
	<input class="btn btn-default btn-block" type="reset" value="{{ trans('kotoba::button.reset') }}">
</div>

<div class="col-sm-4">
<a class="btn btn-default btn-block action_confirm" data-method="delete" title="{{ trans('kotoba::general.command.delete') }}" onclick="">
	<i class="fa fa-trash-o fa-fw"></i>
	{{ trans('kotoba::general.command.delete') }}
</a>
</div>
</div>

</div> <!-- ./ row -->
</div> <!-- ./ wrap/container -->
@stop
