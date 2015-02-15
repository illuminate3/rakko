@extends('app')

{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::account.user', 2) }} :: @parent
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
		<a href="/roles" class="btn btn-default" title="Back">
			<i class="fa fa-chevron-left fa-fw"></i>
			Back
		</a>
	</p>
	<i class="fa fa-edit fa-lg"></i>
	Edit Role
	<hr>
</h1>
</div>


<div class="row">
{!! Form::model(
	$user,
	[
		'route' => ['admin.users.update', $user->id],
		'method' => 'put',
		'class' => 'form-horizontal'
	]
) !!}

<form method="POST" action="http://localhost/roles/1" accept-charset="UTF-8" department="form"><input name="_method" type="hidden" value="PATCH">
<input name="_token" type="hidden" value="uQgEVRmggxhJmVey1FlKR5dUHOQ9tEbYjxTI9sR4">


<div class="form-group">
<div class="input-group">
<span class="input-group-addon"><i class="fa fa-gavel fa-fw"></i></span>
<input class="form-control" placeholder="Name" id="name" required="required" autofocus="autofocus" name="name" type="text" value="Admin">
</div>
</div>


	<div class="form-group">
<div class="input-group">
<span class="input-group-addon"><i class="fa fa-info fa-fw"></i></span>
<input class="form-control" placeholder="Description" id="level" name="description" type="text">
</div>
</div>


	<div class="form-group">
<div class="input-group">
<span class="input-group-addon"><i class="fa fa-signal fa-fw"></i></span>
<input class="form-control" placeholder="Level" id="level" name="level" type="text">
</div>
</div>


	<div class="form-group">
<div class="checkbox">
<label>
<input checked="checked" name="active" type="checkbox" value="1">
&nbsp;Active
</label>
</div>
</div>

	<hr>

	<div class="form-group">
<input class="btn btn-success btn-block" type="submit" value="Save">
</div>


	<div class="row">
		<div class="col-sm-4">
		<a href="/roles" class="btn btn-default btn-block" title="Cancel">
		<i class="fa fa-times fa-fw"></i>Cancel</a>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
<input class="btn btn-default btn-block" type="reset" value="Reset">
</div>

		</div>
		<div class="col-sm-4">
		<a class="btn btn-default btn-block action_confirm" data-method="delete" title="Delete User" onclick=" if ($(this).hasClass('action_confirm')) { if(confirm(&quot;lingos::job_title.ask.delete&quot;)) { $(this).find(&quot;form&quot;).submit(); } } else { $(this).find(&quot;form&quot;).submit(); }">
		<i class="fa fa-trash-o fa-fw"></i>Delete
<form action="/users/%7Busers%7D" method="POST" style="display:none">
 <input type="hidden" name="_method" value="delete">
</form>
</a>
		</div>
	</div>


</form>
</div>



	</div>


<div class="row-fluid">
<h1>
	<p class="pull-right">
	{{-- Bootstrap::linkIcon(
		'roles.index',
		trans('lingos::button.back'),
		'chevron-left fa-fw',
		array('class' => 'btn btn-default')
	) --}}
	</p>
	<i class="fa fa-edit fa-lg"></i>
	{{ trans('kotoba::button.edit') }}
	<hr>
</h1>
</div>


<div class="row">
{!! Form::model(
	$user,
	[
		'route' => ['admin.users.update', $user->id],
		'method' => 'put',
		'class' => 'form-horizontal'
	]
) !!}


	<div class="form-group">
<div class="input-group">
<span class="input-group-addon"><i class="fa fa-gavel fa-fw"></i></span>
<input class="form-control" placeholder="Name" id="name" required="required" autofocus="autofocus" name="name" type="text" value="Admin">
</div>
</div>


	<div class="form-group">
<div class="input-group">
<span class="input-group-addon"><i class="fa fa-info fa-fw"></i></span>
<input class="form-control" placeholder="Description" id="level" name="description" type="text">
</div>
</div>


	<div class="form-group">
<div class="input-group">
<span class="input-group-addon"><i class="fa fa-signal fa-fw"></i></span>
<input class="form-control" placeholder="Level" id="level" name="level" type="text">
</div>
</div>


	<div class="form-group">
<div class="checkbox">
<label>
<input checked="checked" name="active" type="checkbox" value="1">
&nbsp;Active
</label>
</div>
</div>

	<hr>

	<div class="form-group">
<input class="btn btn-success btn-block" type="submit" value="Save">
</div>

<div class="row">
		<div class="col-md-4">
		<a href="/roles" class="btn btn-default btn-block" title="Cancel">
		<i class="fa fa-times fa-fw"></i>Cancel</a>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
<input class="btn btn-default btn-block" type="reset" value="Reset">
</div>

		</div>
		<div class="col-sm-4">
		<a class="btn btn-default btn-block action_confirm" data-method="delete" title="Delete User" onclick=" if ($(this).hasClass('action_confirm')) { if(confirm(&quot;lingos::job_title.ask.delete&quot;)) { $(this).find(&quot;form&quot;).submit(); } } else { $(this).find(&quot;form&quot;).submit(); }">
		<i class="fa fa-trash-o fa-fw"></i>Delete
<form action="/users/%7Busers%7D" method="POST" style="display:none">
 <input type="hidden" name="_method" value="delete">
</form>
</a>
		</div>
		</div>


{!! Form::close() !!}
		</div>


<br>
<br>
<br>
<br>


<a href="/admin" class="btn btn-default" title="{{ trans('kotoba::button.back') }}">
	<i class="fa fa-chevron-left fa-fw"></i>
	{{ trans('kotoba::button.back') }}
</a>

<div class="container">
{!! Form::model(
	$user,
	[
		'route' => ['admin.users.update', $user->id],
		'method' => 'put',
		'class' => 'form-horizontal'
	]
) !!}


<div class="form-group">
	<label for="name" class="col-sm-2 control-label">{{ trans('kotoba::account.name') }}</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" id="name" value="{{ $user->name }}" placeholder="{{ trans('kotoba::account.name') }}">
	</div>
</div>

<div class="form-group">
	<label for="email" class="col-sm-2 control-label">{{ trans('kotoba::account.email') }}</label>
	<div class="col-sm-10">
		<input type="email" class="form-control" id="email" value="{{ $user->email }}" placeholder="{{ trans('kotoba::account.email') }}">
	</div>
</div>

<div class="form-group">
	<label for="password" class="col-sm-2 control-label">{{ trans('kotoba::auth.password') }}</label>
	<div class="col-sm-10">
		<input type="password" class="form-control" id="password" placeholder="{{ trans('kotoba::auth.password') }}">
	</div>
</div>

<div class="form-group">
	<label for="confirm_password" class="col-sm-2 control-label">{{ trans('kotoba::auth.confirm_password') }}</label>
	<div class="col-sm-10">
		<input type="password" class="form-control" id="confirm_password" placeholder="{{ trans('kotoba::auth.confirm_password') }}">
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		<button type="submit" class="btn btn-block btn-success">{{ trans('kotoba::button.submit') }}</button>
	</div>
</div>

{!! Form::close() !!}


	<div class="row">
		<div class="col-sm-4">
		<button type="submit" class="btn btn-block btn-success">{{ trans('kotoba::button.submit') }}</button>
		</div>
		<div class="col-sm-4">
		<button type="submit" class="btn btn-block btn-success">{{ trans('kotoba::button.submit') }}</button>
		</div>
		<div class="col-sm-4">
		<button type="submit" class="btn btn-block btn-success">{{ trans('kotoba::button.submit') }}</button>
		</div>
	</div>
</div>




<div class="page-header">
	<h3>
{{ Lang::choice('kotoba::account.user', 2) }}
	<div class="pull-right">
		<div class="pull-right">
			<a href="{{ URL::to('admin/users/create') }}" class="btn btn-sm  btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> {{ trans('kotoba::button.new') }}</a>
		</div>
	</div>
	</h3>
</div>

<ul class="nav nav-tabs">
	<li class="active">
		<a href="#tab-general" data-toggle="tab">{{ Lang::get('admin/modal.general') }}</a>
	</li>
</ul>
<form class="form-horizontal" method="post" action="@if (isset($user)){{ URL::to('admin/users/' . $user->id . '/edit') }}@endif" autocomplete="off">
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
	<div class="tab-content">
		<div class="tab-pane active" id="tab-general">
			<div class="col-md-12">
			<div class="form-group">
				<label class="col-md-2 control-label" for="name">{{ Lang::get('admin/users.name') }}</label>
				<div class="col-md-10">
					<input class="form-control" tabindex="1" placeholder="{{ Lang::get('admin/users.name') }}" type="text" name="name" id="name" value="{{ Input::old('name', isset($user) ? $user->name : null) }}">
				</div>
			</div>
			</div>
			@if(!isset($user))
                <div class="col-md-12">
                <div class="form-group {{ $errors->has('email') ? 'error' : '' }}">
                    <label class="col-md-2 control-label" for="email">{{ Lang::get('admin/users.email') }}</label>
                    <div class="col-md-10">
                        <input class="form-control" type="email" tabindex="4" placeholder="{{ Lang::get('admin/users.email') }}" name="email" id="email" value="{{ Input::old('email', isset($user) ? $user->email : null) }}" />
                        {{ $errors->first('email', '<span class="help-inline">:message</span>') }}
                    </div>
                </div>
                </div>
			@endif
			<div class="col-md-12">
			<div class="form-group {{ $errors->has('password') ? 'error' : '' }}">
				<label class="col-md-2 control-label" for="password">{{ Lang::get('admin/users.password') }}</label>
				<div class="col-md-10">
					<input class="form-control"  tabindex="5" placeholder="{{ Lang::get('admin/users.password') }}" type="password" name="password" id="password" value="" />
					{{ $errors->first('password', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
			</div>
			<div class="col-md-12">
			<div class="form-group {{ $errors->has('password_confirmation') ? 'error' : '' }}">
				<label class="col-md-2 control-label" for="password_confirmation">{{ Lang::get('admin/users.password_confirmation') }}</label>
				<div class="col-md-10">
					<input class="form-control" type="password" tabindex="6" placeholder="{{ Lang::get('admin/users.password_confirmation') }}"  name="password_confirmation" id="password_confirmation" value="" />
					{{ $errors->first('password_confirmation', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
			</div>
			<div class="col-md-12">
			<div class="form-">
				<label class="col-md-2 control-label" for="confirm">{{ Lang::get('admin/users.activate_user') }}</label>
				<div class="col-md-6">
					<select class="form-control" name="confirmed" id="confirmed">
						<option value="1"{{ ((isset($user) && $user->confirmed == 1)? ' selected="selected"' : '') }}>{{ Lang::get('admin/users.yes') }}</option>
						<option value="0"{{ ((isset($user) && $user->confirmed == 0) ? ' selected="selected"' : '') }}>{{ Lang::get('admin/users.no') }}</option>
					</select>
				</div>
			</div>
			</div>
			<div class="col-md-12">
			<br>
			</div>

{{--
			<div class="col-md-12">
			<div class="form-group">
				<label class="col-md-2 control-label" for="roles">{{ Lang::get('admin/users.roles') }}</label>
				<div class="col-md-6">
					<select name="roles[]" id="roles" multiple style="width:100%;">
						@foreach ($roles as $role)
						<option value="{{ $role->id }}"{{ ( array_search($role->id, $selectedRoles) !== false && array_search($role->id, $selectedRoles) >= 0 ? ' selected="selected"' : '') }}>{{ $role->name }}</option>
						@endforeach
					</select>

					<span class="help-block"> {{ Lang::get('admin/users.roles_info') }} </span>
				</div>
			</div>
			</div>
--}}

		</div>
	</div>
	<div class="form-group">
        <div class="col-md-12">
            <button type="reset" class="btn btn-sm btn-warning close_popup">
                <span class="glyphicon glyphicon-ban-circle"></span>  {{ trans('kotoba::button.cancel') }}
            </button>
            <button type="reset" class="btn btn-sm btn-default">
                <span class="glyphicon glyphicon-remove-circle"></span>  {{ trans('kotoba::button.reset') }}
            </button>
            <button type="submit" class="btn btn-sm btn-success">
                <span class="glyphicon glyphicon-ok-circle"></span> @if (isset($user))  {{ trans('kotoba::button.edit') }} @else  {{ trans('kotoba::button.create') }} @endif
            </button>
        </div>
    </div>
</form>
@stop
