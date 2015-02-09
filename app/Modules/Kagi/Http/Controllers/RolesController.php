<?php namespace App\Modules\Kagi\Http\Controllers;

use App\Modules\Kagi\Http\Controllers\KagiController;
use App\Modules\Kagi\Http\Domain\Role;
use App\Modules\Kagi\Http\Domain\Permission;
use App\Modules\Kagi\Http\Domain\PermissionRole;
use Bllim\Datatables\Facade\Datatables;
use App\Modules\Kagi\Http\Requests\RoleRequest;
use App\Modules\Kagi\Http\Requests\DeleteRequest;

use View, Form;
use Datatable;

/*
use , Input, Redirect, Config, Validator;
use Vedette\models\Role as Role;
use Bootstrap;
*/
class RoleController extends KagiController {

	protected $role;

	public function __construct(Role $role)
	{
		$this->role = $role;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$roles = Role::all();
		return View::make('kagi::roles.index')
			->with(compact("roles"));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make(
			Config::get('vedette.vedette_views.roles_create')
			);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();

		$validation = Validator::make($input, Role::$rules);

		if ($validation->passes())
		{

			$input['name'] = $input['name'];
			$input['description'] = $input['description'];
			if (empty($input['level'])) {
				$input['level'] = NULL;
			} else {
				$input['level'] = $input['level'];
			}
			$input['active'] = (Input::has('active') ? 1 : 0);

			$this->role->create($input);
			return Redirect::route('roles.index')
				->withMessage(Bootstrap::success( trans('lingos::role.success.create'), true, true));
		}

		return Redirect::route('roles.create')
			->withInput()
			->withErrors($validation)
			->withMessage(Bootstrap::danger( trans('lingos::role.error.create'), true, true));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$role = Role::findOrFail($id);

		return View::make(
			Config::get('vedette.vedette_views.roles_edit')
			)->with(compact('role'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 *
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');

		$validation = Validator::make($input, Role::$rulesUpdate);

		if ($validation->passes())
		{
			$role = $this->role->findOrFail($id);

			$role->name = $input['name'];
			$role->description = $input['description'];
			if (empty($input['level'])) {
				$role->level = NULL;
			} else {
				$role->level = $input['level'];
			}
			$role->active = (Input::has('active') ? 1 : 0);

			$role->save($input);

			return Redirect::route('roles.index')
				->withMessage(Bootstrap::success( trans('lingos::role.success.update'), true, true));

		}

		return Redirect::route('roles.edit', $id)
			->withInput()
			->withErrors($validation)
			->withMessage(Bootstrap::danger( trans('lingos::role.error.update'), true, true));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param integer $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
dd('stop!');
		$role = Role::findOrFail($id);
		$role->delete();

		return Redirect::route('roles.index')
			->withMessage(Bootstrap::success( trans('lingos::role.success.delete'), true, true));
	}

}
