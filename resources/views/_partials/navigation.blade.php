<nav class="navbar navbar-default navbar-fixed-top">
<div class="container-fluid">

<div class="navbar-header">
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		<span class="sr-only">Toggle Navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<a class="navbar-brand" href="/welcome">
		{{ Config::get('general.brand_title') }}
	</a>
</div>

<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

@if (Auth::user())

{{-- @if (Auth::user()->can('manage_shisan')) --}}
@if ( Config::get('shisan.show_category_menu') == true)
	<ul class="nav navbar-nav">
		<li>
		<a href="#" class="sitemap" id="showLeft">
			{{ Lang::choice('kotoba::general.category', 2) }}
		</a>
		</li>
	</ul>
@endif
@endif

{{--
	<ul class="nav navbar-nav navbar-right">
		<li class="dropdown messages-menu">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<img alt="" src="{{ asset('assets/images/famfamfam_flag_icons/png/us.png') }}">
				<span class="username">{{ LaravelLocalization::getCurrentLocaleName() }}</span>
				<b class="caret"></b>
			</a>
			<ul class="dropdown-menu">
				@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
					<li>
						<a href="{{LaravelLocalization::getLocalizedURL($localeCode) }}" hreflang="{{$localeCode}}"><img alt="" src="{{ asset('assets/images/famfamfam_flag_icons/png/' . $localeCode . '.png') }}">{{{ $properties['native'] }}}</a>

					</li>
				@endforeach
			</ul>
		</li>
	</ul>
--}}

	@if (Auth::user())
		<ul class="nav navbar-nav">
			@include('_partials.menu', ['items'=> $menu_navbar->roots()])
		</ul>
	@endif
	<ul class="nav navbar-nav navbar-right">
		@if (Auth::guest())
			<li><a href="/auth/login">{{ trans('kotoba::auth.log_in') }}</a></li>
			<li><a href="/auth/register">{{ trans('kotoba::auth.register') }}</a></li>
		@else
	<li>
		@if (Auth::user()->avatar != null)
			<img
				src="{{ asset(Auth::user()->avatar) }}"
				alt="{{ Auth::user()->email }}"
				class="img-circle nav-profile"
			/>
		@else
			<img
				src="{{ asset('/assets/images/usr.png') }}"
				alt="{{ Auth::user()->email }}"
				class="img-circle nav-profile"
			/>
		@endif
	</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					{{ Auth::user()->name }} <span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="/profiles/{{ Auth::user()->id }}">
							{{ Lang::choice('kotoba::account.profile', 1) }}
						</a>
					</li>
				<li class="divider"></li>
@if (Auth::user()->can('manage_admin'))
					<li>
						<a href="/admin/users">
							{{ Lang::choice('kotoba::account.user', 2) }}
						</a>
					</li>
					<li>
						<a href="/admin/roles">
							{{ Lang::choice('kotoba::role.role', 2) }}
						</a>
					</li>
					<li>
						<a href="/admin/permissions">
							{{ Lang::choice('kotoba::permission.permission', 2) }}
						</a>
					</li>
					<li>
						<a href="/admin/manager">
							{{ trans('kotoba::module.manager') }}
						</a>
					</li>
				<li class="divider"></li>
					@if (count($menu_admin->roots()) != 0)
						@include('_partials.menu', ['items'=> $menu_admin->roots()])
						<li class="divider"></li>
					@endif
@endif
					<li>
						<a href="/auth/logout">
							{{ trans('kotoba::auth.log_out') }}
						</a>
					</li>
				</ul>
			</li>
		@endif
	</ul>
</div>

</div><!-- ./container-fluid -->
</nav><!-- /nav -->
