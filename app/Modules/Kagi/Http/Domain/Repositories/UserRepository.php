<?php namespace App\Modules\Kagi\Http\Domain\Repositories;

use App\Modules\Kagi\Http\Domain\Models\User;
use App\Modules\Kagi\Http\Domain\Models\Role;

//use File, Auth;

class UserRepository extends BaseRepository {

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
		Role $role)
	{
		$this->model = $user;
		$this->role = $role;
	}

	/**
	 * Get user collection.
	 *
	 * @param  int  $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit($id)
	{
//dd("edit");
//dd($id);
		$user = $this->getById($id);

//		$select = $this->role->all()->lists('title', 'id');

		return compact('user', 'select');
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
	 * @param $userData
	 * @return static
	 */
	public function findByUsernameOrCreateGithub($userData)
	{
//dd($userData);
		return User::firstOrCreate([
			'name' => $userData->nickname,
			'email'    => $userData->email,
//			'avatar'   => $userData->avatar
		]);
	}

	public function findByUsernameOrCreateGoogle($userData)
	{
//dd($userData);
		return User::firstOrCreate([
			'name' => $userData->name,
			'email'    => $userData->email,
//			'avatar'   => $userData->avatar
		]);
	}
}
