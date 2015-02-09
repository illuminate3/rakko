@extends('app')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get("admin/users.users") }}} :: @parent
@stop

@section('styles')
	<link href="{{asset('assets/admin/css/jquery.dataTables.css')}}" rel="stylesheet">
	<link href="{{asset('assets/admin/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@stop

@section('scripts')
	<script src="{{asset('assets/admin/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/admin/js/dataTables.bootstrap.js')}}"></script>
	<script src="{{asset('assets/admin/js/bootstrap-dataTables-paging.js')}}"></script>
@stop

@section('inline-scripts')
	var oTable;
	$(document).ready(function() {
		oTable = $('#table').dataTable({
			"sDom" : "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
			"sPaginationType" : "bootstrap",
			"bProcessing" : true,
			"bServerSide" : true,
			"sAjaxSource" : "{{ URL::to('admin/users/data/') }}",
		});
	});
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3> {{{ Lang::get("admin/users.users") }}}
	<div class="pull-right">
		<div class="pull-right">
            <a href="{{{ URL::to('admin/users/create') }}}" class="btn btn-sm  btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> {{ Lang::get("admin/modal.new") }}</a>
        </div>
	</div></h3>
</div>

<table id="table" class="table table-striped table-hover">
	<thead>
		<tr>
			<th>{{{ Lang::get("admin/users.name") }}}</th>
			<th>{{{ Lang::get("admin/users.email") }}}</th>
			<th>{{{ Lang::get("admin/users.activate_user") }}}</th>
            <th>{{{ Lang::get("admin/admin.created_at") }}}</th>
            <th>{{{ Lang::get("admin/admin.action") }}}</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>
@stop

{{-- Scripts --}}
@section('scripts1')
<script type="text/javascript">
</script>
@stop
