<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{ trans('kotoba::email.welcome_to') }}{{ Config::get('kagi.site_name') }}</h2>

		<div>
			{{ trans('kotoba::email.register_email') }}
			&nbsp;:&nbsp;
			<a href="{{ url('auth/confirm/'.$confirmation_code) }}">
				{{ trans('kotoba::email.register_link') }}
			</a>
			<br>
			<br>
			{{ url('auth/confirm/'.$confirmation_code) }}
		</div>

	</body>
</html>
