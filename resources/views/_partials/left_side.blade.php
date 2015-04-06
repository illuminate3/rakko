<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">

<h3>
	{{ Lang::choice('kotoba::general.category', 2) }}
</h3>

@if (isset($menu2))
	{!! Html::navy($menu2) !!}
@endif

</nav>
