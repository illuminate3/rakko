@extends('app')

{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::cms.link', 2) }} :: @parent
@stop

@section('styles')
@stop

@section('scripts')
@stop

@section('inline-scripts')
@stop



{{-- Content --}}
@section('content')

<div class="row">
<h1>
	<p class="pull-right">
	<a href="/admin/menus" class="btn btn-default" title="{{ trans('kotoba::button.back') }}">
		<i class="fa fa-chevron-left fa-fw"></i>
		{{ trans('kotoba::button.back') }}
	</a>
	<a href="/admin/menulinks/create" class="btn btn-primary" title="{{ trans('kotoba::button.new') }}">
		<i class="fa fa-plus fa-fw"></i>
		{{ trans('kotoba::button.new') }}
	</a>
	</p>
	<i class="fa fa-chain fa-lg"></i>
	{{ Lang::choice('kotoba::cms.link', 2) }}
	<hr>
</h1>
</div>


@if (count($locales))

<ul class="nav nav-tabs">
	@foreach( $locales as $locale => $properties)
		<li class="@if ($locale == $lang)active @endif">
			<a href="#{{ $properties['id'] }}" data-target="#{{ $properties['id'] }}" data-toggle="tab">{{{ $properties['native'] }}}</a>
		</li>
	@endforeach
</ul>

<div class="tab-content padding-lg margin-bottom-xl">

@foreach( $locales as $locale => $properties)
	<div role="tabpanel" class="tab-pane fade @if ($locale == $lang)in active @endif" id="{{{ $properties['id'] }}}">

@if (count($links))

<div class="row">
<table id="table" class="table table-striped table-hover">
	<thead>
		<tr>
			<th>{{ trans('kotoba::table.title') }}</th>
			<th>{{ trans('kotoba::table.url') }}</th>
			<th>{{ trans('kotoba::table.position') }}</th>
			<th>{{ trans('kotoba::table.menu') }}</th>
			<th>{{ trans('kotoba::table.status') }}</th>
			<th>{{ Lang::choice('kotoba::table.action', 2) }}</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($links as $link)
			<tr>
				<td>
					{{ $link->translate($properties['locale'])->title }}
				</td>
				<td>
					{{ $link->translate($properties['locale'])->url }}
				</td>
				<td>
					{{ $link->position }}
				</td>
				<td>
					{{ $link->present()->menuName($link->menu_id) }}
					{{-- $link->menu_id --}}
				</td>
				<td>
					{{ $link->present()->status( $link->translate($properties['locale'])->status ) }}
					{{-- $link->translate($properties['locale'])->status --}}
				</td>
				<td>
					<a href="/admin/menulinks/{{ $link->id }}/edit" class="btn btn-success" title="{{ trans('kotoba::button.edit') }}">
						<i class="fa fa-pencil fa-fw"></i>
						{{ trans('kotoba::button.edit') }}
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
