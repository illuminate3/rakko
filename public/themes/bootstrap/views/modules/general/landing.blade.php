@extends('app')

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

{{-- dd('die') --}}

	<p>WELCOME!</p>
	<p>WELCOME!</p>

	<p>
		Pellentesque in ipsum id orci porta dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Cras ultricies ligula sed magna dictum porta. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.
	</p>
<br>
<br>
	<p>
		Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vivamus suscipit tortor eget felis porttitor volutpat. Donec rutrum congue leo eget malesuada. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.
	</p>
<br>
<br>
	<p>
		Proin eget tortor risus. Donec sollicitudin molestie malesuada. Proin eget tortor risus. Cras ultricies ligula sed magna dictum porta. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
	</p>
<br>
	<p>
		Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Proin eget tortor risus. Nulla quis lorem ut libero malesuada feugiat. Donec rutrum congue leo eget malesuada. Sed porttitor lectus nibh.
	</p>
<br>
	<p>
		Sed porttitor lectus nibh. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Donec rutrum congue leo eget malesuada. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus.
	</p>

@stop
