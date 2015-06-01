@extends('app')

{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::cms.menu', 2) }} :: @parent
@stop

@section('styles')
	<link href="{{ asset('assets/vendors/Nestable/menu-managment.css') }}" rel="stylesheet">
@stop

@section('scripts')
	<script src="{{ asset('assets/vendors/Nestable/jquery.nestable.js') }}"></script>
@stop

@section('inline-scripts')
$(document).ready(function () {

var updateOutput = function (e) {
	var list = e.length ? e : $(e.target), output = list.data('output');

	if (window.JSON) {
		var jsonData = window.JSON.stringify(list.nestable('serialize'));
		//console.log(window.JSON.stringify(list.nestable('serialize')));
		$.ajax({
			type: "POST",
			url: "{!! URL::route('admin.menu.save') !!}",
			data: {'json': jsonData},
			headers: {
				'X-CSRF-Token': $('meta[name="_token"]').attr('content')
			},
			success: function (response) {

				//$("#msg").append('<div class="alert alert-success msg-save">Saved!</div>');
				$("#msg").append('<div class="msg-save" style="float:right; color:red;">Saving!</div>');
				$('.msg-save').delay(1000).fadeOut(500);
			},
			error: function () {
				alert("error");
			}
		});
	} else {
		alert('error');
	}

};

$('#nestable').nestable({
	group: 1
}).on('change', updateOutput);

});
@stop



{{-- Content --}}
@section('content')

<div class="row">
<h1>
	<p class="pull-right">
	<a href="/admin/menulinks/{{ $menu->id }}/new_link" class="btn btn-primary" title="{{ trans('kotoba::button.new') }}">
		<i class="fa fa-plus fa-fw"></i>
		{{ trans('kotoba::button.new') }}
	</a>
	</p>
	<i class="fa fa-chain fa-lg"></i>
		{{ $menu->name }}
	<i class="fa fa-css3 fa-lg"></i>
		{{ $menu->class }}
	<hr>
</h1>
</div>






@if (count($locales))

<ul class="nav nav-tabs">
	@foreach( $locales as $locale => $properties)
		<li class="@if ($locale == $lang)active @endif">
			<a href="#{{ $locale }}" data-target="#{{ $locale }}" data-toggle="tab">{{{ $properties['native'] }}}</a>
		</li>
	@endforeach
</ul>

<div class="tab-content padding-lg margin-bottom-xl">

@foreach( $locales as $locale => $properties)
	<div role="tabpanel" class="tab-pane fade @if ($locale == $lang)in active @endif" id="{{{ $locale }}}">




<div class="dd" id="nestable">
<ol class="dd-list">
	@foreach ($links as $link)
		<li class="dd-item" data-id="{{ $link->id }}">
		<button type="button" data-action="collapse">Collapse</button>
		<button type="button" data-action="expand" style="display: none;">Expand</button>
			<div class="dd-handle"></div>
				<div class="dd-content">
					{{ $link->{'title:'.$locale} }}
					<div class="ns-actions">
					</div>
				</div>
			</div>
		</li>
	@endforeach
</ol>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
						<a href="/admin/menulinks/{{ $link->id }}/edit" class="btn btn-success" title="{{ trans('kotoba::button.edit') }}">
							<i class="fa fa-pencil fa-fw"></i>
							{{ trans('kotoba::button.edit') }}
						</a>
						<a href="/admin/menulinks/{{ $link->id }}" class="btn btn-info" title="{{ trans('kotoba::button.edit') }}">
							<i class="fa fa-search fa-fw"></i>
							{{ Lang::choice('kotoba::button.link', 2) }}
						</a>
<br>
<br>
<br>
<br>
<br>





@if (count($links))

<div class="row">
<table id="table" class="table table-striped table-hover">
	<thead>
		<tr>
			<th>{{ trans('kotoba::table.position') }}</th>
			<th>{{ trans('kotoba::table.title') }}</th>
			<th>{{ trans('kotoba::table.url') }}</th>
			<th>{{ trans('kotoba::table.status') }}</th>
			<th>{{ Lang::choice('kotoba::table.action', 2) }}</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($links as $link)
			<tr>
				<td>{{ $link->position}}</td>
				<td>{{ $link->{'title:'.$locale} }}</td>
				<td>{{ $link->{'url:'.$locale} }}</td>
				<td>{{ $link->present()->status($link->{'status:'.$locale}) }}</td>
				<td>
					<a href="/admin/menulinks/{{ $link->id }}/edit" class="btn btn-success" title="{{ trans('kotoba::button.edit') }}">
						<i class="fa fa-pencil fa-fw"></i>
						{{ trans('kotoba::button.edit') }}
					</a>
					<a href="/admin/menulinks/{{ $link->id }}" class="btn btn-info" title="{{ trans('kotoba::button.edit') }}">
						<i class="fa fa-search fa-fw"></i>
						{{ Lang::choice('kotoba::button.link', 2) }}
					</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
</div>


@else
<div class="alert alert-info">
	{{ trans('kotoba::general.error.not_found') }}
</div>
@endif



	</div>
@endforeach

</div>

@endif





</div>
@stop
