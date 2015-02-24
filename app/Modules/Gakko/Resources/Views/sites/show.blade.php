@extends('app')

{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::account.site', 2) }} :: @parent
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
	<a href="/sites" class="btn btn-default" title="{{ trans('kotoba::button.back') }}">
		<i class="fa fa-chevron-left fa-fw"></i>
		{{ trans('kotoba::button.back') }}
	</a>
	</p>
	<i class="fa fa-university fa-lg"></i>
	{{{ $site->name }}}
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
		<div class="col-md-4">
			<strong>
				{{ trans('kotoba::account.address') }}:
			</strong>
			<br>
			{{{ $site->address }}}
			<br>
			{{{ $site->city }}}, {{{ $site->state }}}&nbsp;&nbsp;&nbsp;{{{ $site->zipcode }}}
			<br>
			<br>
			<strong>
				{{ trans('kotoba::account.website') }}:
			</strong>
			<br>
			{{{ $site->website }}}


			<br>
			<br>
			<strong>
				{{ trans('kotoba::account.primary_phone') }}:
			</strong>
			<br>
			{{{ $site->primary_phone }}}


			<br>
			<br>
			<strong>
				{{ trans('kotoba::account.secondary_phone') }}:
			</strong>
			<br>
			{{{ $site->secondary_phone }}}


		</div>
		<div class="col-md-4">
			<strong>
				{{ trans('kotoba::general.contact') }}:
			</strong>
			<br>
			{{-- $contact->last_name --}},&nbsp;{{-- $contact->first_name --}}
			{{{ $site->user_id }}}


			<br>
			<br>
			<strong>
				{{ trans('kotoba::hr.division') }}:
			</strong>
			<br>
			{{{ $site->division_id }}}


			<br>
			<br>
			<strong>
				{{ trans('kotoba::account.email') }}:
			</strong>
			<br>
			{{{ $site->email }}}


		</div>
		<div class="col-md-4">
			{{-- $logo --}}
{{-- public_path() --}}

<img src="{!! Image::make('uploads/uni.png')->response('png') !!}" class="logo">

			@if($logo != NULL)
				<img src="{{ $logo }}" class="logo">
			@else
				{{ trans('kotoba::account.error.logo') }}
			@endif

		</div>
	</div><!-- ./row -->
	</div><!-- ./panel-body -->
</div><!-- ./panel -->

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			{{ trans('kotoba::general.introduction') }}
		</h3>
	</div>
	<div class="panel-body">
		{{{ $site->notes }}}
	</div>
</div>


<hr>

<div class="form-group">
	<input class="btn btn-success btn-block" type="submit" value="{{ trans('kotoba::button.save') }}">
</div>

{!! Form::close() !!}


<div class="row">
<div class="col-sm-4">
	<a href="/sites" class="btn btn-default btn-block" title="{{ trans('kotoba::button.cancel') }}">
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
