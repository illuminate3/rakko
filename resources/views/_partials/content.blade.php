@include('flash::message')


@if (count($errors) > 0)
	@include('_partials.errors')
@endif


@yield('content')

User ID: @if(isset(Auth::user()->id)) {{ Auth::user()->id }} @endif

{!! $menu_public->asUl() !!}

{{ var_dump($errors) }}

{{--
@if (Auth::user()->can('manage_admin'))
Hello
@endif
--}}
