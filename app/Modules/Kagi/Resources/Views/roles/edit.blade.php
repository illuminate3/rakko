@extends('app')

{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::role.role', 2) }} :: @parent
@stop

@section('styles')
	<link href="{{ asset('assets/vendors/multiselect_12_11_14/css/style.css') }}" rel="stylesheet">
@stop

@section('scripts')
	<script type="text/javascript" src="{{ asset('assets/js/restfulizer.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/vendors/multiselect_12_11_14/js/multiselect.min.js') }}"></script>
@stop

@section('inline-scripts')
	var text_confirm_message = '{{ trans('kotoba::account.ask.delete') }}';

	jQuery(document).ready(function($) {
		$('#multiselect').multiselect();
	});
@stop


{{-- Content --}}
@section('content')

<div id="wrap" class="container">

<div class="row">
<h1>
	<p class="pull-right">
	<a href="/admin/roles" class="btn btn-default" title="{{ trans('kotoba::button.back') }}">
		<i class="fa fa-chevron-left fa-fw"></i>
		{{ trans('kotoba::button.back') }}
	</a>
	</p>
	<i class="fa fa-edit fa-lg"></i>
	{{ trans('kotoba::role.command.edit') }}
	<hr>
</h1>
</div>


<div class="row">
{!! Form::model(
	$role,
	[
		'route' => ['admin.roles.update', $role->id],
		'method' => 'PATCH',
		'class' => 'form'
	]
) !!}


<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-gavel fa-fw"></i></span>
		<input type="text" id="name" name="name" value="{{ $role->name }}" placeholder="{{ trans('kotoba::account.name') }}" class="form-control" autofocus="autofocus">
</div>
</div>


<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-bookmark fa-fw"></i></span>
		<input type="text" id="slug" name="slug" value="{{ $role->slug }}" placeholder="{{ trans('kotoba::general.slug') }}" class="form-control">
</div>
</div>


<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-briefcase fa-fw"></i></span>
		<input type="text" id="description" name="description" value="{{ $role->name }}" placeholder="{{ trans('kotoba::general.description') }}" class="form-control">
</div>
</div>

@foreach ($permissions as $permission)
<li>
	{{ $permission->name }}
</li>
@endforeach


<div class="row">
	<div class="col-sm-5">
		<select name="from" id="multiselect" class="col-sm-12" size="12" multiple="multiple">
			<option value="1">Item 1</option>
			<option value="2">Item 5</option>
			<option value="2">Item 2</option>
			<option value="2">Item 4</option>
			<option value="3">Item 3</option>
		</select>
	</div>

	<div class="col-sm-2">
		<button type="button" id="multiselect_rightAll" class="btn btn-default btn-block"><i class="fa fa-fast-forward fa-fw"></i></button>
		<button type="button" id="multiselect_rightSelected" class="btn btn-default btn-block"><i class="fa fa-chevron-right fa-fw"></i></button>
		<button type="button" id="multiselect_leftSelected" class="btn btn-default btn-block"><i class="fa fa-chevron-left fa-fw"></i></button>
		<button type="button" id="multiselect_leftAll" class="btn btn-default btn-block"><i class="fa fa-fast-backward fa-fw"></i></button>
	</div>

	<div class="col-sm-5">
		<select name="to" id="multiselect_to" class="col-sm-12" size="12" multiple="multiple"></select>
	</div>
</div>


<hr>

<div class="form-group">
	<input class="btn btn-success btn-block" type="submit" value="{{ trans('kotoba::button.save') }}">
</div>

{!! Form::close() !!}


<div class="row">
<div class="col-sm-4">
	<a href="/admin/roles" class="btn btn-default btn-block" title="{{ trans('kotoba::button.cancel') }}">
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
