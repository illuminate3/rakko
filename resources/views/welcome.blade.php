@extends('module_info')

{{-- Web site Title --}}
@section('title')
{{ Config::get('general.title') }} :: @parent
@stop

@section('styles')
@stop

@section('scripts')
@stop

@section('inline-scripts')
@stop


{{-- Content --}}
@section('content')

	<div class="container">
		<div class="content">
			<a href="/">
				<img src="/assets/images/rakko.jpg">
			</a>
			<div class="title">
				<a href="/">
					{{ Config::get('general.title') }}
				</a>
			</div>
			<div class="quote">{{ Inspiring::quote() }}</div>
		</div>
	</div>

@stop
