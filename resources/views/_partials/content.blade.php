@include('flash::message')

@yield('content')

User ID: @if(isset(Auth::user()->id)) {{ Auth::user()->id }} @endif

{!! $menu_public->asUl() !!}

{{-- var_dump($errors) --}}
