<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="container">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		{{ HTML::linkRoute(
			Config::get('vedette.vedette_routes.home'),
			Config::get('vedette.vedette_html.project_name'),
			null,
			array(
				'class' => 'navbar-brand'
			)
		) }}
	</div>
	<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav">

@include(Config::get('vedette.vedette_html.include_nav'))

{{--
			<li {{ (Request::is('/') ? ' class="active"' : '') }}>
				{{ HTML::linkRoute(
					'home',
					trans('lingos::general.home')
				) }}
			</li>
--}}
		</ul>
		<ul class="nav navbar-nav pull-right">
			@if (Auth::check())
				@if (Auth::user()->hasRoleWithName('Admin'))
{{--
					<li {{ (Request::is('admin*') ? ' class="active"' : '') }}>{{ HTML::linkRoute('admin.index', 'Administration') }}</li>
--}}
	<li class="dropdown">
{{--
		<a class="dropdown-toggle {{ (Request::is('auth*') ? ' active' : '') }}" data-toggle="dropdown" href="#">
--}}
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">

			{{ Auth::user()->email }}
			<b class="caret"></b>
		</a>
		<ul class="dropdown-menu">
				<li><a href="{{ route('admin.users.index') }}"><i class="fa fa-users"></i>{{ trans('lingos::account.users') }}</a></li>
				<li><a href="{{ route('admin.roles.index') }}"><i class="fa fa-gavel"></i>{{ trans('lingos::role.roles') }}</a></li>
{{--
				<li><a href="{{ route('vedette.permissions') }}"><i class="fa fa-wrench"></i>{{ trans('lingos::sentry.permissions') }}</a></li>
--}}
			<li class="divider"></li>
			<li>
				{{ HTML::linkRoute('admin.users.show', trans('lingos::account.profile'), array(Auth::user()->id)) }}
			</li>
{{--
			<li>
				<a href="{{ route('vedette.admin') }}">
					<i class="fa fa-gear"></i>
					{{ trans('lingos::account.profile') }}
				</a>
			</li>
--}}
		</ul>
	</li>


				@endif
{{--
				<li {{ (Request::is('user*') ? ' class="active"' : '') }}>{{ HTML::linkRoute('user.show', 'Logged in as ' . Auth::user()->email, array(Auth::user()->id)) }}</li>
--}}
				<li>{{ HTML::linkRoute('logout', 'Logout') }}</li>
			@else
				<li {{ (Request::is('login') ? ' class="active"' : '') }}>{{ HTML::linkRoute('login', 'Login') }}</li>
				<li {{ (Request::is('register') ? ' class="active"' : '') }}>{{ HTML::linkRoute('register', 'Register') }}</li>
			@endif
		</ul>
	</div>
</div>
</div>
