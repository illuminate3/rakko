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
			{{{ $site->phone_1 }}}


			<br>
			<br>
			<strong>
				{{ trans('kotoba::account.secondary_phone') }}:
			</strong>
			<br>
			{{{ $site->phone_2 }}}


		</div>
		<div class="col-md-4">
			<strong>
				{{ trans('kotoba::general.contact') }}:
			</strong>
			<br>
			{{{ $site->user_id }}}


			<br>
			<br>
			<strong>
				{{ Lang::choice('kotoba::hr.division', 1) }}:
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
			@if($logo != NULL)
				{!! Html::image($logo, '', ['class' => 'img-thumbnail']) !!}
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

</div> <!-- ./ row -->
</div> <!-- ./ wrap/container -->

@stop
