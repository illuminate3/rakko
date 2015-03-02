@extends(Config::get('vedette.vedette_views.layout'))

@section('title')
@parent
	{{ Config::get('vedette.vedette_html.separator') }}
	{{ trans('lingos::general.command.create') }}
@stop

@section('styles')
@stop

@section('scripts')
@stop

@section('inline-scripts')
@stop

@section('content')
<div class="row">
<h1>
	<p class="pull-right">
	{{ Bootstrap::linkIcon(
		'items.index',
		trans('lingos::button.back'),
		'chevron-left fa-fw',
		array('class' => 'btn btn-default')
	) }}
	</p>
	<i class="fa fa-edit fa-lg"></i>
	{{ trans('lingos::general.command.create') }}
	<hr>
</h1>
</div>


@if ($errors->any())
	{{ Bootstrap::danger( implode('', $errors->all(':message<br>')), true) }}

	<div class="alert alert-danger">
		<ul>
			{{ implode('', $errors->all('<li class="error">:message</li>')) }}
		</ul>
	</div>
@endif


<div class="row">
{{ Form::open(array('route' => 'items.store', 'class' => 'form-horizontal')) }}

{{-- Form::open(
	[
		'route' => array('items.store'),
		'job_title' => 'form'
	]
) --}}

        <div class="form-group">
            {{ Form::label('make', 'Make:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('make', Input::old('make'), array('class'=>'form-control', 'placeholder'=>'Make')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('model', 'Model:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('model', Input::old('model'), array('class'=>'form-control', 'placeholder'=>'Model')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('model_number', 'Model_number:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('model_number', Input::old('model_number'), array('class'=>'form-control', 'placeholder'=>'Model_number')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('description', 'Description:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::textarea('description', Input::old('description'), array('class'=>'form-control', 'placeholder'=>'Description')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('image', 'Image:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('image', Input::old('image'), array('class'=>'form-control', 'placeholder'=>'Image')) }}
            </div>
        </div>


@if (!isset($category) || !$category->isRoot())
{{ Form::beginGroup('category_id') }}
    {{ Form::label('category_id', 'Parent', array('class' => 'col-lg-2 control-label')) }}
    <div class="col-lg-10">
        {{ Form::select('category_id', $parents, null, array('class' => 'form-control', 'required' => true)) }}
    </div>
{{ Form::endGroup('category_id') }}
@endif

	<hr>

	{{ Bootstrap::submit(
		trans('lingos::button.save'),
		[
			'class' => 'btn btn-success btn-block'
		]
	) }}

	<div class="row">
		<div class="col-sm-6">
		{{ Bootstrap::linkIcon(
			'items.index',
			trans('lingos::button.cancel'),
			'times fa-fw',
			[
				'class' => 'btn btn-default btn-block'
			]
		) }}
		</div>
		<div class="col-sm-6">
		{{ Bootstrap::reset(
			trans('lingos::button.reset'),
			[
				'class' => 'btn btn-default btn-block'
			]
		) }}
		</div>
	</div>

{{ Form::close() }}

</div>
@stop
