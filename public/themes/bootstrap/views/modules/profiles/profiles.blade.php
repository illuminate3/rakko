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
			<div class="title">Profiles</div>
			<div class="quote">
				Profiles is a Rakko module that extends the ability to add User Profiles
			</div>
		</div>
	</div>

@stop
