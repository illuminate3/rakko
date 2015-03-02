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
		'asset.index',
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
{{ Form::open(array('route' => 'asset.store', 'class' => 'form-horizontal')) }}

{{-- Form::open(
	[
		'route' => array('asset.store'),
		'job_title' => 'form'
	]
) --}}

{{--
        <div class="form-group">
            {{ Form::label('item_id', 'Item_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'item_id', Input::old('item_id'), array('class'=>'form-control')) }}
            </div>
        </div>
--}}
<div class="form-group">
	<label for="inputZone" class="col-sm-2 control-label">Item:</label>
	<div class="col-sm-10">
		{{
			Form::select(
				'item_id',
				$items,
				null,
				array(
					'class' => 'form-control chosen-select'
				)
			)
		}}
	</div>
</div>


<div class="form-group">
	<label for="inputZone" class="col-sm-2 control-label">User:</label>
	<div class="col-sm-10">
		{{
			Form::select(
				'user_id',
				$users,
				null,
				array(
					'class' => 'form-control chosen-select'
				)
			)
		}}
	</div>
</div>


{{--
        <div class="form-group">
            {{ Form::label('site_id', 'Site_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'site_id', Input::old('site_id'), array('class'=>'form-control')) }}
            </div>
        </div>
--}}

<div class="form-group">
	<label for="inputZone" class="col-sm-2 control-label">Site:</label>
	<div class="col-sm-10">
		{{
			Form::select(
				'site_id',
				$sites,
				null,
				array(
					'class' => 'form-control chosen-select'
				)
			)
		}}
	</div>
</div>

{{--
        <div class="form-group">
            {{ Form::label('room', 'Room:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'room', Input::old('room'), array('class'=>'form-control')) }}
            </div>
        </div>
--}}

<div class="form-group">
	<label for="inputZone" class="col-sm-2 control-label">Room:</label>
	<div class="col-sm-10">
		{{
			Form::select(
				'room_id',
				$rooms,
				null,
				array(
					'class' => 'form-control chosen-select'
				)
			)
		}}
	</div>
</div>

{{--
        <div class="form-group">
            {{ Form::label('statuses_tech_id', 'Statuses_tech_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'statuses_tech_id', Input::old('statuses_tech_id'), array('class'=>'form-control')) }}
            </div>
        </div>
--}}
<div class="form-group">
	<label for="inputStatus" class="col-sm-1 control-label">Asset Status:</label>
	<div class="col-sm-10">
		{{
			Form::select(
				'asset_status_id',
				$statuses,
				Input::old('asset_status_id'),
				array(
					'class' => 'form-control'
				)
			)
		}}
	</div>
</div>

        <div class="form-group">
            {{ Form::label('asset_tag', 'Asset_tag:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('asset_tag', Input::old('asset_tag'), array('class'=>'form-control', 'placeholder'=>'Asset_tag')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('serial', 'Serial:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('serial', Input::old('serial'), array('class'=>'form-control', 'placeholder'=>'Serial')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('po', 'Purchase Order #:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('po', Input::old('po'), array('class'=>'form-control', 'placeholder'=>'Purchase Order Number')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('barcode', 'Barcode:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('barcode', Input::old('barcode'), array('class'=>'form-control', 'placeholder'=>'Barcode')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('note', 'Note:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::textarea('note', Input::old('note'), array('class'=>'form-control', 'placeholder'=>'Note')) }}
            </div>
        </div>


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
			'asset.index',
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
