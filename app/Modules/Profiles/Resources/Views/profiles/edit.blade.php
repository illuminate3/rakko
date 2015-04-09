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
	<i class="fa fa-esit fa-lg"></i>
	{{ trans('kotoba::account.command.edit') }}
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
{!! Form::hidden('id', $profile->id) !!}
{!! Form::hidden('user_id', $profile->user_id) !!}


<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-angle-double-left fa-fw"></i></span>
		<input type="text" id="prefix" name="prefix" value="{{ $profile->prefix }}" placeholder="{{ trans('kotoba::account.prefix') }}" class="form-control" autofocus="autofocus">
</div>
</div>
<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-angle-left fa-fw"></i></span>
		<input type="text" id="first_name" name="first_name" value="{{ $profile->first_name }}" placeholder="{{ trans('kotoba::account.first_name') }}" class="form-control">
</div>
</div>
<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-arrows-h fa-fw"></i></span>
		<input type="text" id="middle_name" name="middle_name" value="{{ $profile->middle_name }}" placeholder="{{ trans('kotoba::account.middle_name') }}" class="form-control">
</div>
</div>
<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-angle-right fa-fw"></i></span>
		<input type="text" id="last_name" name="last_name" value="{{ $profile->last_name }}" placeholder="{{ trans('kotoba::account.last_name') }}" class="form-control">
</div>
</div>
<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-angle-double-right fa-fw"></i></span>
		<input type="text" id="suffix" name="suffix" value="{{ $profile->suffix }}" placeholder="{{ trans('kotoba::account.suffix') }}" class="form-control">
</div>
</div>

<hr>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-at fa-fw"></i></span>
		<input type="text" id="email_1" name="email_1" value="{{ $profile->email_1 }}" placeholder="{{ trans('kotoba::account.email_1') }}" class="form-control">
</div>
</div>
<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-at fa-fw"></i></span>
		<input type="text" id="email_2" name="email_2" value="{{ $profile->email_2 }}" placeholder="{{ trans('kotoba::account.email_2') }}" class="form-control">
</div>
</div>

<hr>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
		<input type="text" id="phone_1" name="phone_1" value="{{ $profile->phone_1 }}" placeholder="{{ trans('kotoba::account.phone_1') }}" class="form-control">
</div>
</div>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-fax fa-fw"></i></span>
		<input type="text" id="phone_2" name="phone_2" value="{{ $profile->phone_2 }}" placeholder="{{ trans('kotoba::account.phone_2') }}" class="form-control">
</div>
</div>

<hr>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-road fa-fw"></i></span>
		<input type="text" id="address" name="address" value="{{ $profile->address }}" placeholder="{{ trans('kotoba::account.address') }}" class="form-control">
</div>
</div>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-home fa-fw"></i></span>
		<input type="text" id="city" name="city" value="{{ $profile->city }}" placeholder="{{ trans('kotoba::account.city') }}" class="form-control">
</div>
</div>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-star fa-fw"></i></span>
		<input type="text" id="state" name="state" value="{{ $profile->state }}" placeholder="{{ trans('kotoba::account.state') }}" class="form-control">
</div>
</div>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-paper-plane fa-fw"></i></span>
		<input type="text" id="zipcode" name="zipcode" value="{{ $profile->zipcode }}" placeholder="{{ trans('kotoba::account.zipcode') }}" class="form-control">
</div>
</div>

<hr>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
		<input type="text" id="notes" name="notes" value="{{ $profile->notes }}" placeholder="{{ Lang::choice('kotoba::general.note', 2) }}" class="form-control">
</div>
</div>


{{--
<div class="form-group">
	<label for="inputLogo" class="col-sm-2 control-label">{{ trans('lingos::account.picture') }}:</label>
	<div class="col-sm-4">
		<div class="logo-container">
			@if ($picture)
				{{ Form::hidden('picture', $profile->picture) }}

				<img
						src="{{ $profile->picture }}"
					alt="{{ Auth::user()->email }}"
					class="img-circle profile"
				/>

			@else
				<span class="logo-alt">{{ trans('lingos::account.error.logo') }}</span>
			@endif
		</div>
	</div>
	<div class="col-sm-6">
		{{ Form::file('picture') }}
	</div>
</div>
--}}



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
<!-- Button trigger modal -->
	<a data-toggle="modal" data-target="#myModal" class="btn btn-default btn-block" title="{{ trans('kotoba::button.delete') }}">
		<i class="fa fa-trash-o fa-fw"></i>
		{{ trans('kotoba::general.command.delete') }}
	</a>
</div>
</div>


</div> <!-- ./ row -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	@include('_partials.modal')
</div>


@stop
