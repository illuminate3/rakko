<?php
namespace App\Modules\Kagi\Http\Domain\Repositories;

use App\Modules\Kagi\Http\Domain\Models\User;
use App\Modules\Kagi\Http\Domain\Models\Role;
use Caffeinated\Shinobi\Models\Role as shinobiRole;
//use Caffeinated\Shinobi\Traits\ShinobiTrait;

use Hash, DB, Auth, Config, Eloquent;
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
		$this->user = $user;
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
//		$user = $this->user->with('roles')->findOrFail($id);
		$user = $this->user->findOrFail($id);
//		$user = $this->getById($id);
//dd($user);
$roles = $this->getRoles();
//dd($roles);

		return compact('user', 'roles');
	}

	/**
	 * Get user collection.
	 *
	 * @param  int  $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit($id)
	{
		$user = $this->user->find($id);
//dd($user);

		$userRoles = User::find($id)->roles;
		$roles = $this->shinobiRole->lists('name', 'id');
		$allRoles =  $this->role->all()->lists('name', 'id');

		return compact('user', 'roles', 'allRoles', 'userRoles');
	}

	/**
	 * Get all models.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function store($input)
	{
//dd($input);
		$this->user = new User;
		$this->user->create($input);
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
		$user = $this->user->find($id);

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
			$user->blocked = 1;
		} else {
			$user->blocked = 0;
		}
		if ( isset($input['banned']) ) {
			$user->banned = 1;
		} else {
			$user->banned = 0;
		}
		if ( isset($input['confirmed']) ) {
			$user->confirmed = 1;
		} else {
			$user->confirmed = 0;
		}
		if ( isset($input['activated']) ) {
			$user->activated = 1;
			$user->activated_at = date("Y-m-d H:i:s");

		} else {
			$user->activated = 0;
			$user->activated_at = NULL;
		}
//dd($user);

		$user->update();

		$user->syncRoles($input['roles']);
	}


// Functions --------------------------------------------------

	public function getRoles()
	{
//		$roles = $this->role->all();
		if (! is_null($this->shinobiRole)) {
			return $this->shinobiRole->lists('name');
		}

		return null;
	}


	public function checkUserExists($name, $email)
	{
		$user = DB::table('users')
			->where('name', '=', $name)
			->where('email', '=', $email, 'AND')
			->first();
//dd($user);

		return $user;
	}

	/**
	 * Update user login timestamp
	 *
	 * @param  int  $email
	 * @return
	 */
	public function touchLastLogin($id)
	{
		return DB::table('users')
			->where('id', '=', $id)
			->update([
				'last_login' => date("Y-m-d H:i:s")
			]);
	}

	/**
	 * @param $userData
	 * @return static
	 */
	public function findByUsernameOrCreateGithub($userData)
	{
//dd($userData);
//	protected $fillable = ['name', 'email', 'password', 'blocked', 'banned', 'confirmed', 'activated'];

		if ($userData->name == NULL) {
			$name = $userData->nickname;
		}
		if ($userData->email == NULL) {
			$email = $userData->nickname;
		}
		$date = date("Y-m-d H:i:s");

		$check = $this->checkUserExists($name, $email);
		if ($check == NULL) {
			return User::create([
				'name'					=> $name,
				'email'					=> $email,
//				'avatar'				=> $userData->avatar,
				'blocked'				=> 0,
				'banned'				=> 0,
				'confirmed'				=> 1,
				'activated'				=> 1,
				'activated_at'			=> $date,
				'last_login'			=> $date,
				'confirmation_code'		=> md5(microtime().Config::get('app.key'))
			]);
		} else {
//dd($check->id);
			$this->touchLastLogin($check->id);
			return User::firstOrCreate([
				'name'					=> $name,
				'email'					=> $email,
			]);
		}

	}

	public function findByUsernameOrCreateGoogle($userData)
	{
//dd($userData);
//	protected $fillable = ['name', 'email', 'password', 'blocked', 'banned', 'confirmed', 'activated'];
		return User::firstOrCreate([
			'name'					=> $userData->name,
			'email'					=> $userData->email,
//			'avatar'				=> $userData->avatar,
			'activated_at'			=> date("Y-m-d H:i:s"),
			'blocked'				=> 0,
			'banned'				=> 0,
			'confirmed'				=> 1,
			'activated'				=> 1,
			'confirmation_code'		=> md5(microtime().Config::get('app.key'))
		]);
	}


}
