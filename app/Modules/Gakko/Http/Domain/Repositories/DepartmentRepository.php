<?php
namespace App\Modules\Gakko\Http\Domain\Repositories;

use App\Modules\Gakko\Http\Domain\Models\Department;

use DB;
//use Hash, DB, Auth;
//use DateTime;
//use File, Auth;

class DepartmentRepository extends BaseRepository {

	/**
	 * The Module instance.
	 *
	 * @var App\Modules\ModuleManager\Http\Domain\Models\Module
	 */
	protected $department;

	/**
	 * Create a new ModuleRepository instance.
	 *
   	 * @param  App\Modules\ModuleManager\Http\Domain\Models\Module $module
	 * @return void
	 */
	public function __construct(
		Department $department
		)
	{
		$this->model = $department;
	}

	/**
	 * Get user collection.
	 *
	 * @param  string  $slug
	 * @return Illuminate\Support\Collection
	 */
	public function show($id)
	{
		$module = $this->module->find($id);
//dd($module);

		return compact('module');
	}

	/**
	 * Get user collection.
	 *
	 * @param  int  $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit($id)
	{
		$module = $this->module->find($id);
//dd($module);

		return compact('module');
	}

	/**
	 * Get all models.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function store($input)
	{
//dd($input);
		$this->model = new User;
		$this->model->create($input);
	}

	/**
	 * Update a role.
	 *
	 * @param  array  $inputs
	 * @param  int    $id
	 * @return void
	 */
	public function update($input, $id)
	{
//dd($input['enabled']);
		$module = Module::find($id);
//dd($module->name);

		if ($input['enabled'] == 0 ) {
			$module->enabled = 0;
			ModuleFacade::disable($module->name);
		} else {
			$module->enabled = 1;
			ModuleFacade::enable($module->name);
//ModuleFacade::setProperty($module->name . '::enabled', true);
		}

		return $module->update();
	}


}
