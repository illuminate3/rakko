<div class="modal-dialog">
<div class="modal-content">


	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('kotoba::general.command.close') }}"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">
		{{ $modal_title }}
		</h4>
	</div>

	<div class="modal-body">
		<p>
		{{ $modal_body }}
		</p>
	</div>


{!! Form::model(
	$model,
	[
		'route' => [$modal_route, $modal_id],
		'method' => 'DELETE',
		'class' => 'form'
	]
) !!}
{!! Form::hidden('id', $modal_id) !!}

	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">
		{{ trans('kotoba::button.cancel') }}
		</button>

		<button type="submit" class="btn btn-danger">
		{{ trans('kotoba::button.delete') }}
		</button>
	</div>

{!! Form::close() !!}


</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
