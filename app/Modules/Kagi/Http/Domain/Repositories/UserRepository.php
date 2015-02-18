<?php namespace App\Modules\Kagi\Http\Domain\Repositories;

use App\Modules\Kagi\Http\Domain\Models\User;
use App\Modules\Kagi\Http\Domain\Models\Role;
use Caffeinated\Shinobi\Models\Role as shinobiRole;

use Hash, DB, Auth;
use DateTime;
//use File, Auth;

class UserRepository extends BaseRepository {

	/**
	 * The User instance.
	 *
	 * @var App\Models\User
	 */
	protected $user;

	/**
	 * The Role instance.
	 *
	 * @var App\Models\Role
	 */
	protected $role;

	/**
	 * Create a new UserRepository instance.
	 *
   	 * @param  App\Modules\Kagi\Http\Domain\Models\User $user
	 * @param  App\Modules\Kagi\Http\Domain\Models\Role $role
	 * @return void
	 */
	public function __construct(
		User $user,
		Role $role,
		shinobiRole $shinobiRole
		)
	{
		$this->model = $user;
		$this->role = $role;
		$this->shinobiRole = $shinobiRole;
	}

	/**
	 * Get user collection.
	 *
	 * @param  string  $slug
	 * @return Illuminate\Support\Collection
	 */
	public function show($id)
	{
		$user = $this->model->with('roles')->findOrFail($id);
//		$user = $this->getById($id);
//dd($user);

		return compact('user');
	}

	/**
	 * Get user collection.
	 *
	 * @param  int  $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit($id)
	{
		$user = $this->model->find($id);
//dd($user);
		$roles = $this->shinobiRole->lists('name', 'id');
		$allRoles =  $this->role->all()->lists('name', 'id');

		return compact('user', 'roles', 'allRoles');
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
//dd($input);
		$user = $this->getById($id);

		if ( isset($input['name']) ) {
			$user->name = $input['name'];
		}
		if ( isset($input['email']) ) {
			$user->email = $input['email'];
		}

		if ( $input['password'] != NULL ) {
			$user->password = Hash::make($input['password']);
		}

		if ( isset($input['blocked']) ) {
//			$user->blocked = $input['blocked'];
			$user->blocked = 1;
		} else {
			$user->blocked = 0;
		}
		if ( isset($input['banned']) ) {
//			$user->banned = $input['banned'];
			$user->banned = 1;
		} else {
			$user->banned = 0;
		}
		if ( isset($input['confirmed']) ) {
//			$user->confirmed = $input['confirmed'];
			$user->confirmed = 1;
		} else {
			$user->confirmed = 0;
		}
		if ( isset($input['activated']) ) {
//			$user->activated = $input['activated'];
			$user->activated = 1;
			$user->activated_at = date("Y-m-d H:i:s");

		} else {
			$user->activated = 0;
			$user->activated_at = NULL;
		}
//dd($user);

		$user->update();

		$user->syncRoles($input['my-select']);
	}


}
