<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{ trans('kotoba::email.password_reset') }}</h2>

		<div>
			{{ trans('kotoba::email.password_email') }}
			&nbsp;:&nbsp;
			<a href="{{ url('password/reset/'.$token) }}">
				{{ trans('kotoba::email.password_link') }}
			</a>
			<br>
			<br>
			{{ url('password/reset/'.$token) }}
		</div>

	</body>
</html>
