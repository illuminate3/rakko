@if ($menu = Linker::getMenu($name))

	@if ($menu->menulinks->count())
	<ul class="{{ $menu->class }}">
		@foreach ($menu->menulinks as $menulink)
			@include('modules.general.typi._item')
		@endforeach
	</ul>
	@endif

@endif
