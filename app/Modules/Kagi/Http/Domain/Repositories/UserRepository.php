<?php namespace App\Modules\Kagi\Http\Domain\Repositories;

use App\Modules\Kagi\Http\Domain\Models\User;
use App\Modules\Kagi\Http\Domain\Models\Role;
//use Caffeinated\Shinobi\Models\Role;

use Hash, DB;
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
		Role $role
		)
	{
		$this->model = $user;
		$this->role = $role;
	}

	/**
	 * Get user collection.
	 *
	 * @param  string  $slug
	 * @return Illuminate\Support\Collection
	 */
	public function show($id)
	{
//dd("show");
//dd($id);
//		$user = $this->model->with('role')->findOrFail($id);
		$user = $this->getById($id);

//		$statut = $this->getStatut();

		return compact('user' ,'statut');
	}

	/**
	 * Get user collection.
	 *
	 * @param  int  $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit($id)
	{
		$user = $this->getById($id);
/*
$role = Role::find(1);
$role->revokeAllPermissions();
$role->save();
//$role->assignPermission(1);
//$role->save();
dd($role);
$permissions = $role->getPermissions();
dd($permissions);
*/

//		$select = $this->role->all()->lists('title', 'id');

		return compact('user', 'select');
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

		if ( $input['password'] != NULL ) {
			$user->password = Hash::make($input['password']);
		}

		if ( isset($input['verified']) ) {
			$user->verified = $input['verified'];
		}
		if ( isset($input['banned']) ) {
			$user->banned = $input['banned'];
		}
		if ( isset($input['confirmed']) ) {
			$user->confirmed = $input['confirmed'];
		}
		if ( isset($input['activated']) ) {
			$user->activated = $input['activated'];
		}
//dd($user);

		$user->update();
	}


}
