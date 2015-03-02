@extends(Config::get('vedette.vedette_views.layout'))

@section('title')
@parent
	{{ Config::get('vedette.vedette_html.separator') }}
: Scans
@stop

@section('scripts')
	<script src="{{ asset('assets/vendors/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/vendors/Datatables-Bootstrap3/BS3/assets/js/datatables.js') }}"></script>
@stop

@section('styles')
	<link rel="stylesheet" href="{{ asset('assets/vendors/Datatables-Bootstrap3/BS3/assets/css/datatables.css') }}">
@stop

@section('inline-scripts')
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
} );
@stop


@section('content')

<h1>
	Scans [index]
	<hr>
</h1>


<div class="row">
<a href="{{{ URL::to('scans/pallet') }}}" class="btn btn-primary btn-block">Scan Pallet</a>
<br>
<a href="{{{ URL::to('scans/rack') }}}" class="btn btn-primary btn-block">Scan Rack</a>
</div>



@stop
