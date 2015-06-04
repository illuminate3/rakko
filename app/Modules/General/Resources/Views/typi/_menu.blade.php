@if ($menu = Menus::getMenu($name))

    @if ($menu->menulinks->count())
    <ul class="{{ $menu->class }}">
        @foreach ($menu->menulinks as $menulink)
            @include('menus::public._item')
        @endforeach
    </ul>
    @endif

@endif
