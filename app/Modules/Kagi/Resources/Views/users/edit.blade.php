@extends('app')

{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::account.user', 2) }} :: @parent
@stop

@section('styles')
	<link href="{{ asset('assets/vendors/multi-select_v0_9_12/css/multi-select.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/vendors/illuminate3/css/standard.css') }}" rel="stylesheet">
@stop

@section('scripts')
	<script type="text/javascript" src="{{ asset('assets/js/restfulizer.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/vendors/multi-select_v0_9_12/js/jquery.multi-select.js') }}"></script>
@stop

@section('inline-scripts')
	var text_confirm_message = '{{ trans('kotoba::account.ask.delete') }}';
	jQuery(document).ready(function($) {
		$('#my-select').multiSelect(
			{
				selectableFooter: "<div class='bg-primary padding-md'>{{ trans('kotoba::general.available') }}</div>",
				selectionFooter: "<div class='bg-primary padding-md'>{{ trans('kotoba::general.assigned') }}</div>"
			}
		)
	});
@stop


{{-- Content --}}
@section('content')

<div id="wrap" class="container">

<div class="row">
<h1>
	<p class="pull-right">
	<a href="/admin/users" class="btn btn-default" title="{{ trans('kotoba::button.back') }}">
		<i class="fa fa-chevron-left fa-fw"></i>
		{{ trans('kotoba::button.back') }}
	</a>
	</p>
	<i class="fa fa-edit fa-lg"></i>
	{{ trans('kotoba::general.command.edit') }}
	<hr>
</h1>
</div>


@if (count($errors) > 0)
	@include('kagi::_partials.errors')
@endif


<div class="row">
{!! Form::model(
	$user,
	[
		'route' => ['admin.users.update', $user->id],
		'method' => 'PATCH',
		'class' => 'form'
	]
) !!}


<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
		<input type="text" id="name" name="name" value="{{ $user->name }}" placeholder="{{ trans('kotoba::account.name') }}" class="form-control" autofocus="autofocus">
</div>
</div>


<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
		<input type="text" id="email" name="email" value="{{ $user->email }}" placeholder="{{ trans('kotoba::account.email') }}" class="form-control">
</div>
</div>


<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
		<input type="password" id="password" name="password" value="" placeholder="{{ trans('kotoba::auth.password') }}" class="form-control">
</div>
</div>


<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-key fa-fw fa-rotate-180"></i></span>
		<input type="password" id="password_confirmation" name="password_confirmation" value="" placeholder="{{ trans('kotoba::auth.password_confirmation') }}" class="form-control">
</div>
</div>


<div class="form-group">

	<label class="checkbox-inline">
		<input type="checkbox" id="blocked" name="blocked" value="1" {{ $user->present()->blocked }}>
		&nbsp;{{ trans('kotoba::general.blocked') }}
	</label>

	<label class="checkbox-inline">
		<input type="checkbox" id="banned" name="banned" value="1" {{ $user->present()->banned }}>
		&nbsp;{{ trans('kotoba::general.banned') }}
	</label>

	<label class="checkbox-inline">
		<input type="checkbox" id="confirmed" name="confirmed" value="1" {{ $user->present()->confirmed }}>
		&nbsp;{{ trans('kotoba::general.confirmed') }}
	</label>

	<label class="checkbox-inline">
		<input type="checkbox" id="activated" name="activated" value="1" {{ $user->present()->activated }}>
		&nbsp;{{ trans('kotoba::general.activated') }}
	</label>

</div>




<hr>
<h3>
	<i class="fa fa-gavel fa-fw"></i>
	{{ Lang::choice('kotoba::role.role', 2) }}
</h3>
<select multiple="multiple" id="my-select" name="my-select[]">
@foreach ($allRoles as $key => $value)
	@if (isset($roles[$key]) )
		<option value='{{ $key }}' selected>{{ $value }}</option>
	@else
		<option value='{{ $key }}'>{{ $value }}</option>
	@endif
@endforeach
</select>


<hr>

<div class="form-group">
	<input class="btn btn-success btn-block" type="submit" value="{{ trans('kotoba::button.save') }}">
</div>

{!! Form::close() !!}


<div class="row">
<div class="col-sm-4">
	<a href="/admin/users" class="btn btn-default btn-block" title="{{ trans('kotoba::button.cancel') }}">
		<i class="fa fa-times fa-fw"></i>
		{{ trans('kotoba::button.cancel') }}
	</a>
</div>

<div class="col-sm-4">
	<input class="btn btn-default btn-block" type="reset" value="{{ trans('kotoba::button.reset') }}">
</div>

<div class="col-sm-4">
	<a class="btn btn-danger btn-block action_confirm" data-method="delete" title="{{ trans('kotoba::general.command.delete') }}" onclick="">
		<i class="fa fa-trash-o fa-fw"></i>
		{{ trans('kotoba::general.command.delete') }}
	</a>
</div>
</div>

</div> <!-- ./ row -->
</div> <!-- ./ wrap/container -->

@stop
