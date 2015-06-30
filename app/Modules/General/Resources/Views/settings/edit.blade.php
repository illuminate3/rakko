@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Config::get('site.app_key') }}}
@parent
: Edit Department
@stop

@section('content')

<h1>
	Edit: {{ $setting->key }}
</h1>

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

{{ Form::model(
	$setting,
	array(
		'method' => 'PATCH',
		'route' => array('settings.update', $setting->key),
		'class' => 'form-horizontal',
		'role' => 'form'
	))
}}


{{ Form::textField('key', 'Name:',
	Input::old('key'),
	array(
		'class' => 'form-control',
		'id' => 'key',
		'placeholder' => 'Name',
		'tabindex' => '1',
	))
}}

{{ Form::textField('value', 'Value:',
	Input::old('value'),
	array(
		'class' => 'form-control',
		'id' => 'value',
		'placeholder' => 'Value',
		'tabindex' => '2',
	))
}}


	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			{{ Form::submit('Update',
				array(
					'class' => 'btn btn-success btn-lg btn-block',
					'tabindex' => '3'
				))
			}}
		</div>
<br>
		<div class="controls">
			{{-- link_to_route('settings.show', 'Cancel', $setting->key, array('class' => 'btn btn-danger')) --}}
			{{ Form::reset('Reset', array('class' => 'btn btn-info')) }}
		</div>
	</div>

{{ Form::close() }}

@stop
