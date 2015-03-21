@extends('app')

{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::module.module', 2) }} :: @parent
@stop

@section('styles')
@stop

@section('scripts')
	<script type="text/javascript" src="{{ asset('assets/js/restfulizer.js') }}"></script>
@stop

@section('inline-scripts')
	var text_confirm_message = '{{ trans('kotoba::account.ask.delete') }}';
@stop


{{-- Content --}}
@section('content')

<div id="wrap" class="container">

<div class="row">
<h1>
	<p class="pull-right">
	<a href="/admin/manager" class="btn btn-default" title="{{ trans('kotoba::button.back') }}">
		<i class="fa fa-chevron-left fa-fw"></i>
		{{ trans('kotoba::button.back') }}
	</a>
	</p>
	<i class="fa fa-edit fa-lg"></i>
		{{ trans('kotoba::general.command.edit') }}
	<hr>
</h1>
</div>


<div class="row">
{!! Form::model(
	$module,
	[
		'route' => ['admin.manager.update', $module->id],
		'method' => 'PATCH',
		'class' => 'form'
	]
) !!}


<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			{{ trans('kotoba::general.information') }}:
		</h3>
	</div><!-- ./panel-heading -->
	<div class="panel-body">

		<div class="table-responsive">
		<table class="table table-striped table-hover">
			<tbody>
				<tr>
					<td>
						{{ trans('kotoba::general.name') }}
					</td>
					<td>
						{{ $module->name }}
					</td>
				</tr>
				<tr>
					<td>
						{{ trans('kotoba::general.slug') }}
					</td>
					<td>
						{{ $module->slug }}
					</td>
				</tr>
				<tr>
					<td>
						{{ trans('kotoba::general.description') }}
					</td>
					<td>
						{{ $module->description }}
					</td>
				</tr>
				<tr>
					<td>
						{{ trans('kotoba::general.version') }}
					</td>
					<td>
						{{ $module->version }}
					</td>
				</tr>
			</tbody>
		</table>
		</div><!-- ./responsive -->

	</div><!-- ./panel-body -->
</div><!-- ./panel -->

<hr>

<label class="checkbox-inline">
	<input type="checkbox" id="enabled" name="enabled" value="1" {{ $module->present()->enabledCheck }}>
	&nbsp;{{ trans('kotoba::general.enabled') }}
</label>


<hr>

<div class="form-group">
	<input class="btn btn-success btn-block" type="submit" value="{{ trans('kotoba::button.save') }}">
</div>

{!! Form::close() !!}


<div class="row">
<div class="col-sm-6">
	<a href="/admin/manager" class="btn btn-default btn-block" title="{{ trans('kotoba::button.cancel') }}">
		<i class="fa fa-times fa-fw"></i>
		{{ trans('kotoba::button.cancel') }}
	</a>
</div>

<div class="col-sm-6">
	<input class="btn btn-default btn-block" type="reset" value="{{ trans('kotoba::button.reset') }}">
</div>
</div>

</div> <!-- ./ row -->
</div> <!-- ./ wrap/container -->
@stop
