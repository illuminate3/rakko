<nav class="navbar navbar-default navbar-fixed-top">
<div class="container-fluid">

<div class="navbar-header">
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		<span class="sr-only">Toggle Navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<a class="navbar-brand" href="/">
		{{ Config::get('general.brand_title') }}
	</a>
</div>

<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	<ul class="nav navbar-nav">
		<li><a href="/">{{ trans('kotoba::general.home') }}</a></li>
	</ul>

	<ul class="nav navbar-nav navbar-right">
		@if (Auth::guest())
			<li><a href="/auth/login">{{ trans('kotoba::auth.log_in') }}</a></li>
			<li><a href="/auth/register">{{ trans('kotoba::auth.register') }}</a></li>
		@else
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="/profiles/{{ Auth::user()->id }}">
							{{ Lang::choice('kotoba::account.profile', 1) }}
						</a>
					</li>
				<li class="divider"></li>
{{-- @if (Auth::user()->can('manage_admin')) --}}
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
						<a href="/module_manager">
							{{ trans('kotoba::module.manager') }}
						</a>
					</li>
				<li class="divider"></li>
{{-- @endif --}}
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
