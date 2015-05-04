@include('flash::message')

@if (count($errors) > 0)
	@include('_partials.errors')
@endif

@if (session('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
@endif

@yield('content')

{{--
User ID: @if(isset(Auth::user()->id)) {{ Auth::user()->id }} @endif
--}}

{{-- $menu_public->asUl() --}}

{{-- var_dump($errors) --}}



{{--
{{ LaravelLocalization::getCurrentLocale() }}
/
{{ LaravelLocalization::getCurrentLocaleName() }}
/
{{ LaravelLocalization::getCurrentLocaleDirection() }}
/
{{ LaravelLocalization::getCurrentLocaleScript() }}
/

<ul class="language_bar_chooser">
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
{{{ $localeCode }}}
        <li>
            <a rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
                {{{ $properties['native'] }}} 123
            </a>
        </li>
    @endforeach
</ul>
/
--}}
