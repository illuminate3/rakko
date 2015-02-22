<div class="row-fuild">
	@if (Session::has('message'))
		{{ Session::get('message') }}
	@endif
</div>

@yield('content')
