<li id="menuitem_{{ $menulink->id }}" class="{{ $menulink->class }}" role="menuitem">
    <a href="{{ url($menulink->href) }}" @if($menulink->target) target="{{ $menulink->target }}" @endif @if($menulink->items->count()) class="dropdown-toggle" data-toggle="dropdown" @endif>
        @if ($menulink->icon_class)
            <span class="{{ $menulink->icon_class }}"></span>
        @endif
        {{ $menulink->title }}
        @if ($menulink->items->count())
            <span class="caret"></span>
        @endif
    </a>
    @if ($menulink->items->count())
        <ul class="dropdown-menu">
            @foreach ($menulink->items as $menulink)
                @include('menus::public._item', ['menulink' => $menulink])
            @endforeach
        </ul>
    @endif
</li>
