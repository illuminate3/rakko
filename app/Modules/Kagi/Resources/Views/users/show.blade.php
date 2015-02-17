@extends('app')

{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::account.user', 2) }} :: @parent
@stop

@section('styles')
@stop

@section('scripts')
	<script type="text/javascript" src="{{ asset('assets/js/restfulizer.js') }}"></script>
@stop

@section('inline-scripts')
	var text_confirm_message = '{{ trans('kotoba::account.ask.delete') }}';
@stop


{{-- Content --}}
@section('content')

<div id="wrap" class="container">
<div class="row">

<div class="row">
<h1>
	<p class="pull-right">
	<a href="/admin/users" class="btn btn-default" title="{{ trans('kotoba::button.back') }}">
		<i class="fa fa-chevron-left fa-fw"></i>
		{{ trans('kotoba::button.back') }}
	</a>
	</p>
	<i class="fa fa-user fa-lg"></i>
	{{ $user->name }}
	&nbsp;:&nbsp;
	{{ $user->email }}
	<hr>
</h1>
</div>

<div class="row">

	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#info" data-toggle="tab">
				<i class="fa fa-user fa-fw"></i>
				{{ trans('kotoba::general.information') }}
			</a>
		</li>
		<li>
			<a href="#roles" data-toggle="tab">
				<i class="fa fa-gavel fa-fw"></i>
				{{ Lang::choice('kotoba::role.role', 2) }}
			</a>
		</li>
		<li>
			<a href="#user_control" data-toggle="tab">
				<i class="fa fa-sort-amount-asc fa-fw"></i>
				{{ trans('kotoba::auth.user_control') }}
			</a>
		</li>
		<li>
			<a href="#status" data-toggle="tab">
				<i class="fa fa-heart fa-fw"></i>
				{{ trans('kotoba::general.status') }}
			</a>
		</li>
	</ul>

	<div id="myTabContent" class="tab-content">
	<div class="tab-pane active" id="info">

		<fieldset>
			<h2>
				<legend>
					<i class="fa fa-user fa-fw"></i>
					{{ trans('kotoba::general.information') }}
				</legend>
			</h2>

			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tbody>
					<tr>
						<td>{{ trans('kotoba::account.name') }}</td>
						<td>{{ $user->name }}</td>
					</tr>
					<tr>
						<td>{{ trans('kotoba::account.email') }}</td>
						<td>{{ $user->email }}</td>
					</tr>
				</tbody>
			</table>
			</div><!-- ./responsive -->

		</fieldset>

	</div><!-- tab-info -->
	<div class="tab-pane" id="roles">

		<fieldset>
			<h2>
				<legend>
					<i class="fa fa-gavel fa-fw"></i>
					{{ Lang::choice('kotoba::role.role', 2) }}
				</legend>
			</h2>

			<div class="panel panel-default">
				<div class="panel-body">
					{{-- $user->present()->roles() --}}
				</div>
			</div>

		</fieldset>

	</div><!-- tab-roles -->
	<div class="tab-pane" id="user_control">

		<fieldset>
			<h2>
				<legend>
					<i class="fa fa-sort-amount-asc fa-fw"></i>
					{{ trans('kotoba::auth.user_control') }}
				</legend>
			</h2>

			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tbody>
					<tr>
						<td>{{ trans('kotoba::general.verified') }}</td>
						<td>{!! $user->present()->iconVerified !!}</td>
					</tr>
					<tr>
						<td>{{ trans('kotoba::general.banned') }}</td>
						<td>{!! $user->present()->iconBanned !!}</td>
					</tr>
					<tr>
						<td>{{ trans('kotoba::general.confirmed') }}</td>
						<td>{!! $user->present()->iconConfirmed !!}</td>
					</tr>
					<tr>
						<td>{{ trans('kotoba::general.activated') }}</td>
						<td>{!! $user->present()->iconActivated !!}</td>
					</tr>
				</tbody>
			</table>
			</div><!-- ./responsive -->

		</fieldset>

	</div><!-- tab-information -->
	<div class="tab-pane" id="status">

		<fieldset>
			<h2>
				<legend>
					<i class="fa fa-heart fa-fw"></i>
					{{ trans('kotoba::general.status') }}
				</legend>
			</h2>

			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tbody>
					<tr>
						<td>{{ trans('kotoba::account.last_login') }}</td>
						<td>{{ $user->last_login }}</td>
					</tr>
					<tr>
						<td>{{ trans('kotoba::account.created_at') }}</td>
						<td>{{ $user->created_at }}</td>
					</tr>
					<tr>
						<td>{{ trans('kotoba::account.updated_at') }}</td>
						<td>{{ $user->updated_at }}</td>
					</tr>
				</tbody>
			</table>
			</div><!-- ./responsive -->

		</fieldset>

	</div><!-- tab-status -->
	</div><!-- tab-content -->

	<hr>

	<div class="row">
		<div class="col-sm-4">
			<a href="/admin/users" class="btn btn-default btn-block" title="{{ trans('kotoba::button.back') }}">
				<i class="fa fa-chevron-left fa-fw"></i>
				{{ trans('kotoba::button.back') }}
			</a>
		</div>
		<div class="col-sm-4">
			<a href="/admin/users/{{ $user->id }}/edit" class="btn btn-success btn-block" title="{{ trans('kotoba::button.edit') }}">
				<i class="fa fa-pencil fa-fw"></i>
				{{ trans('kotoba::button.edit') }}
			</a>
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
