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
			<div class="title">Kagi</div>
			<div class="quote">
				鍵 : kagi
				<br>
				noun - key also can refer to the lock itself
				<br>
				Kagi is a module for Laravel 5 Authentification and Authorization
			</div>
		</div>
	</div>

@stop
