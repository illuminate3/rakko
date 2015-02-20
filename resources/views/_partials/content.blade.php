@include('flash::message')

@yield('content')

User ID: {{ Auth::user()->id }}

{!! $menu_public->asUl() !!}

{{-- var_dump($errors) --}}
