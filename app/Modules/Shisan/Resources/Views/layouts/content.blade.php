@if (Session::has('message'))
	<div class="row">
		{{ Session::get('message') }}
	</div>
@endif
@if (Session::has('success'))
	<div class="row">
		{{ Session::get('success') }}
	</div>
@endif

{{-- Display some alerts --}}
@foreach (array('error', 'warning', 'success') as $key)
	@if (Session::has($key))
	<div class="alert alert-dismissable alert-{{ $key === 'error' ? 'danger' : $key }}">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ Session::get($key) }}
	</div>
	@endif
@endforeach


@if (isset($breadcrumbs) && !empty($breadcrumbs))
<div class="row">
	<ul class="breadcrumb">
	@foreach ($breadcrumbs as $label => $url)
		@if (is_numeric($label))
			<li class="active">{{{ $url }}}</li>
		@else
			<li><a href="{{ $url }}">{{{ $label }}}</a></li>
		@endif
	@endforeach
	</ul>
	<hr>
</div>
@endif


@yield('content')
{{ $content }}

{{-- $items --}}
{{--

@section('menu')
    @if (isset($menu))
    <ul class="nav navbar-nav">
        @foreach ($menu as $item)
        <li @if(isset($item['active']) && $item['active'])class="active"@endif>
            <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
        </li>
        @endforeach
    </ul>
    @endif

    <ul class="nav navbar-nav pull-right">
        <li>
            <a href="{{ URL::to('categories') }}"><span class="glyphicon glyphicon-wrench"></span> Manage</a>
        </li>
    </ul>
@stop
--}}

@if ( isset($mainMenu) )
	{{ HTML::navclean($mainMenu) }}
@endif
