@extends('app')

{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::hr.site', 2) }} :: @parent
@stop

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/chosen_v1.0.0/chosen.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/chosen_v1.0.0/chosen_bootstrap.css') }}">
@stop

@section('scripts')
	<script type="text/javascript" src="{{ asset('assets/vendors/chosen_v1.0.0/chosen.jquery.min.js') }}"></script>
@stop

@section('inline-scripts')
	jQuery(document).ready(function($) {
		$(".chosen-select").chosen();
	});
@stop


{{-- Content --}}
@section('content')

<div id="wrap" class="container">

<div class="row">
<h1>
	<p class="pull-right">
	<a href="/sites" class="btn btn-default" title="{{ trans('kotoba::button.back') }}">
		<i class="fa fa-chevron-left fa-fw"></i>
		{{ trans('kotoba::button.back') }}
	</a>
	</p>
	<i class="fa fa-edit fa-lg"></i>
	{{ trans('kotoba::general.command.create') }}
	<hr>
</h1>
</div>


<div class="row">
{!! Form::open([
	'url' => 'sites',
	'method' => 'POST',
	'class' => 'form'
]) !!}


<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-gavel fa-fw"></i></span>
		<input type="text" id="name" name="name" placeholder="{{ trans('kotoba::account.name') }}" class="form-control" autofocus="autofocus">
</div>
</div>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-road fa-fw"></i></span>
		<input type="text" id="address" name="address" placeholder="{{ trans('kotoba::account.address') }}" class="form-control">
</div>
</div>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-home fa-fw"></i></span>
		<input type="text" id="city" name="city" placeholder="{{ trans('kotoba::account.city') }}" class="form-control">
</div>
</div>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-star fa-fw"></i></span>
		<input type="text" id="state" name="state" placeholder="{{ trans('kotoba::account.state') }}" class="form-control">
</div>
</div>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-paper-plane fa-fw"></i></span>
		<input type="text" id="zipcode" name="zipcode" placeholder="{{ trans('kotoba::account.zipcode') }}" class="form-control">
</div>
</div>


<div class="form-group padding-bottom-xl">
	<label for="inputDivision" class="col-sm-1 control-label">{{ Lang::choice('kotoba::hr.division', 1) }}:</label>
	<div class="col-sm-11">
		{!!
			Form::select(
				'division_id',
				$divisions,
				Input::old('division_id'),
				array(
					'class' => 'form-control chosen-select'
				)
			)
		!!}
	</div>
</div>

<div class="form-group padding-bottom-xl">
	<label for="inputContact" class="col-sm-1 control-label">{{ trans('kotoba::general.contact') }}:</label>
	<div class="col-sm-11">
		{!!
			Form::select(
				'user_id',
				$contacts,
				Input::old('user_id'),
				array(
					'class' => 'form-control chosen-select'
				)
			)
		!!}
	</div>
</div>

<div class="form-group padding-bottom-xl">
	<label for="inputStatus" class="col-sm-1 control-label">{{ trans('kotoba::general.status') }}:</label>
	<div class="col-sm-11">
		{!!
			Form::select(
				'status_id',
				$statuses,
				Input::old('status_id'),
				array(
					'class' => 'form-control chosen-select'
				)
			)
		!!}
	</div>
</div>


<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
		<input type="text" id="phone_1" name="phone_1" placeholder="{{ trans('kotoba::account.phone_1') }}" class="form-control">
</div>
</div>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-fax fa-fw"></i></span>
		<input type="text" id="phone_2" name="phone_2" placeholder="{{ trans('kotoba::account.phone_2') }}" class="form-control">
</div>
</div>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-link fa-fw"></i></span>
		<input type="text" id="website" name="website" placeholder="{{ trans('kotoba::account.website') }}" class="form-control">
</div>
</div>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-at fa-fw"></i></span>
		<input type="text" id="email" name="email" placeholder="{{ trans('kotoba::general.email') }}" class="form-control">
</div>
</div>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
		<textarea id="notes" name="notes" placeholder="{{ trans('kotoba::general.notes') }}" class="form-control" rows="5"></textarea>
</div>
</div>


<hr>


<div class="form-group">
	<input class="btn btn-success btn-block" type="submit" value="{{ trans('kotoba::button.save') }}">
</div>

{!! Form::close() !!}


<div class="row">
<div class="col-sm-6">
	<a href="/sites" class="btn btn-default btn-block" title="{{ trans('kotoba::button.cancel') }}">
		<i class="fa fa-times fa-fw"></i>
		{{ trans('kotoba::button.cancel') }}
	</a>
</div>

<div class="col-sm-6">
	<input class="btn btn-default btn-block" type="reset" value="{{ trans('kotoba::button.reset') }}">
</div>
</div>

</div> <!-- ./ row -->
</div> <!-- ./ wrap/container -->
@stop
