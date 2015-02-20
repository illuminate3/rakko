@include('flash::message')

@yield('content')

{!! $menu_public->asUl() !!}

{{-- var_dump($errors) --}}
