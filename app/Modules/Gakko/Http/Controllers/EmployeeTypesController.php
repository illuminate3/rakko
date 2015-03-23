<?php
namespace App\Modules\Gakko\Http\Controllers;

use App\Modules\Gakko\Http\Domain\Models\EmployeeType;
use App\Modules\Gakko\Http\Domain\Repositories\EmployeeTypeRepository;

use Illuminate\Http\Request;
use App\Modules\Gakko\Http\Requests\EmployeeTypeCreateRequest;
use App\Modules\Gakko\Http\Requests\EmployeeTypeUpdateRequest;
use App\Modules\Gakko\Http\Requests\DeleteRequest;

use Datatables;
use Flash;

class EmployeeTypesController extends GakkoController {

	/**
	 * EmployeeType Repository
	 *
	 * @var EmployeeType
	 */
	protected $employee_type;

	public function __construct(
			EmployeeTypeRepository $employee_type
		)
	{
		$this->employee_type = $employee_type;

		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View('gakko::employee_types.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('gakko::employee_types.create',  $this->employee_type->create());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		EmployeeTypeCreateRequest $request
		)
	{
		$this->employee_type->store($request->all());

		Flash::success( trans('kotoba::hr.success.employee_type_create') );
		return redirect('admin/employee_types');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
// 		$employee_type = $this->employee_type->findOrFail($id);
//
// 		return View::make('HR::employee_types.show', compact('employee_type'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$modal_title = trans('kotoba::general.command.delete');
		$modal_body = trans('kotoba::general.ask.delete');
		$modal_route = 'admin.employee_types.destroy';
		$modal_id = $id;
		$model = '$employee_type';

		return View('gakko::employee_types.edit',
			$this->employee_type->edit($id),
				compact(
					'modal_title',
					'modal_body',
					'modal_route',
					'modal_id',
					'model'
			));
//		return View('gakko::employee_types.edit',  $this->employee_type->edit($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		EmployeeTypeUpdateRequest $request,
		$id
		)
	{
//dd("update");
		$this->employee_type->update($request->all(), $id);

		Flash::success( trans('kotoba::hr.success.employee_type_update') );
		return redirect('admin/employee_types');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->employee_type->find($id)->delete();

		return Redirect::route('admin.employee_types.index');
	}

	/**
	* Datatables data
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//		$query = EmployeeType::select(array('employee_types.id','employee_types.name','employee_types.description'))
//			->orderBy('employee_types.name', 'ASC');
//		$query = EmployeeType::select('id', 'name' 'description', 'updated_at');
//			->orderBy('name', 'ASC');
		$query = EmployeeType::select('id', 'name', 'description', 'updated_at');
//dd($query);

		return Datatables::of($query)
//			->remove_column('id')

			->addColumn(
				'actions',
				'
					<a href="{{ URL::to(\'admin/employee_types/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
						<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
					</a>
				'
				)

			->make(true);
	}


}
