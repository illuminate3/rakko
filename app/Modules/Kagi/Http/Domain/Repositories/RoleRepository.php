<?php namespace App\Modules\Kagi\Http\Domain\Repositories;

use App\Modules\Kagi\Http\Domain\Models\Role;
use App\Modules\Kagi\Http\Domain\Models\Permission;
use Caffeinated\Shinobi\Models\Role as shinobiRole;

//use File, Auth;
use DB;

class RoleRepository extends BaseRepository {

	/**
	 * The Role instance.
	 *
	 * @var App\Models\Role
	 */
	protected $role;

	/**
	 * Create a new RoleRepository instance.
	 *
	 * @param  App\Modules\Kagi\Http\Domain\Models\Role $role
	 * @return void
	 */
	public function __construct(
		Role $role,
		Permission $permission,
		shinobiRole $shinobiRole
		)
	{
		$this->model = $role;
		$this->permission = $permission;
		$this->role = $shinobiRole;
	}


	/**
	 * Get role collection.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function create()
	{
		$allPermissions =  $this->permission->all()->lists('name', 'id');
//dd($allPermissions);

		return compact('allPermissions');
	}

	/**
	 * Get user collection.
	 *
	 * @param  int  $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit($id)
	{
		$role = $this->role->find($id);
		$permissions = $role->permissions->lists('name', 'id');
		$allPermissions =  $this->permission->all()->lists('name', 'id');

		return compact('role', 'allPermissions', 'permissions');
	}

	/**
	 * Get all models.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function store($input)
	{
//dd($input);
		$this->model = new Role;
		$this->model->create($input);

		$role_id = DB::getPdo()->lastInsertId();
		$role = $this->role->find($role_id);
		$role->syncPermissions($input['my-select']);
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
//dd($input);
		$role = $this->role->find($id);
		$role->update($input);

		$role->syncPermissions($input['my-select']);
	}

}
