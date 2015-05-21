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
			<div class="title">Installer</div>
			<div class="quote">
				Installer
				<br>
				A basic INstaller for Rakko
			</div>
		</div>
	</div>

@stop
