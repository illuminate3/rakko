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
				@if($profile->user->avatar)
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
		{{{ $profile->notes }}}
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
</div> <!-- ./ wrap/container -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	@include('_partials.modal')
</div>


@stop
