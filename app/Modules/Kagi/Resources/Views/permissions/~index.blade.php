@extends('app')

{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::permission.permission', 2) }} :: @parent
@stop

@section('styles')
	<link rel="stylesheet" href="{{ asset('packages/illuminate3/vedette/assets/vendors/Datatables-Bootstrap3/BS3/assets/css/datatables.css') }}">
@stop

@section('scripts')
	<script src="{{ asset('packages/illuminate3/vedette/assets/js/restfulizer.js') }}"></script>
	<script src="{{ asset('packages/illuminate3/vedette/assets/vendors/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
@stop

@section('inline-scripts')
var text_confirm_message = '{{ trans('kotoba::account.ask.delete') }}';
$(document).ready(function() {

	$('#DataTable').dataTable({
		stateSave: true
	});
	$('#DataTable').each(function(){
		var datatable = $(this);
		var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
		search_input.attr('placeholder', 'Search');
		search_input.addClass('form-control input-sm');
		var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
		length_sel.addClass('form-control input-sm');
	});

});
@stop



{{-- Content --}}
@section('content')

<div class="row">
<h1>
	<p class="pull-right">
	<a href="/admin/permissions/create" class="btn btn-primary" title="{{ trans('kotoba::button.new') }}">
		<i class="fa fa-plus fa-fw"></i>
		{{ trans('kotoba::button.new') }}
	</a>
	</p>
	<i class="fa fa-gavel fa-lg"></i>
		{{ Lang::choice('kotoba::permission.permission', 2) }}
	<hr>
</h1>
</div>


<div class="row">
<!--
"dom" : "T<'clear'>lfrtip",

<table id="table" class="table table-striped table-hover">
	<thead>
		<tr>
			<th>{{ trans('kotoba::account.name') }}</th>
			<th>{{ trans('kotoba::general.slug') }}</th>
			<th>{{ trans('kotoba::general.description') }}</th>
			<th>{{ trans('kotoba::general.created_at') }}</th>
			<th>{{ trans('kotoba::general.action') }}</th>
		</tr>
	</thead>
	<tbody></tbody>
-->


{!! Datatable::table()
	->addColumn('id',trans('kotoba::account.name'), trans('kotoba::general.slug'), trans('kotoba::general.description'), trans('kotoba::general.created_at'), trans('kotoba::general.action'))
	->setUrl( URL::to('admin/api/permissions') )
	->setOptions(array(
		'dom' =>"T<'clear'>lfrtip",
		'tabletools' => array(
			"aSwfPath" => "/assets/Datatables/extensions/TableTools/swf/copy_csv_cls_pdf.swf"
		)
	))
	->render(Config::get('chumper.table.table_view'))
!!}

{{ dd(Config::get('chumper_datatable.table.table_view')) }}

</div>

@stop
