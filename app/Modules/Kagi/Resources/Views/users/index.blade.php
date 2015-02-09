@extends('app')

@section('title')
@parent
	{{ Config::get('general.separator') }}
	{{ trans('kotoba::account.users') }}
@stop

@section('styles')
	<link rel="stylesheet" href="{{ asset('assets/vendors/Datatables-Bootstrap3/BS3/assets/css/datatables.css') }}">
@stop

@section('scripts')
	<script src="{{ asset('assets/js/restfulizer.js') }}"></script>
	<script src="{{ asset('assets/vendors/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
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

@section('content')
<div class="row">
<h1>
	<p class="pull-right">
	@if (Auth::check())
	@endif
	</p>
	<i class="fa fa-group fa-lg"></i>
	{{ Lang::choice('kotoba::account.user', 2) }}
	<hr>
</h1>
</div>

<div class="row">
@if (count($users))


<div>
<br>
<br>
{{--
{!!
dd(Datatable::table()
    ->addColumn('id',trans('kotoba::table.email'), Lang::choice('kotoba::table.role', 2), Lang::choice('kotoba::table.action', 2))
    ->setUrl(route('api.users'))
    ->setOptions(array(
        'dom' =>"T<'clear'>lfrtip",
        'tabletools' => array(
            "aSwfPath" => "/assets/Datatables/extensions/TableTools/swf/copy_csv_cls_pdf.swf"
        )
    ))
    ->render('_partials.datatable'));
    !!}
--}}
{{-- Datatable::table()
	->addColumn('id',trans('kotoba::table.email'), Lang::choice('kotoba::table.role', 2), Lang::choice('kotoba::table.action', 2))
	->setUrl(route('api.users'))
	->setOptions(array(
		'dom' =>"T<'clear'>lfrtip",
		'tabletools' => array(
			"aSwfPath" => "/assets/Datatables/extensions/TableTools/swf/copy_csv_cls_pdf.swf"
		)
	))
	->render('_partials.datatable')
--}}
<br>
<br>
</div>

<div class="table-responsive">
<table class="table table-striped table-hover" id="DataTable">
	<thead>
		<tr>
			<th>#</th>
			<th>{{ trans('kotoba::table.email') }}</th>
			<th>{{ Lang::choice('kotoba::table.role', 2) }}</th>
			<th>{{ Lang::choice('kotoba::table.action', 2) }}</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($users as $user)
			<tr>
				<td>{{ $user->id }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->name }}</td>
				<td width="25%">
					{!! Form::open(array(
						'route' => array('admin.users.destroy', $user->id),
						'role' => 'form',
						'method' => 'delete',
						'class' => 'form-inline'
					)) !!}

					{!! Form::close() !!}
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
</div><!-- ./responsive -->

@else
	{{-- Bootstrap::info( trans('kotoba::general.no_records'), true) --}}
@endif
</div>
@stop
