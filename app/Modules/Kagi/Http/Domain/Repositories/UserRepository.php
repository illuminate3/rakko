<?php
namespace App\Modules\Kagi\Http\Domain\Repositories;

use Caffeinated\Shinobi\Models\Role as shinobiRole;
use App\Modules\Kagi\Http\Domain\Models\Role;
use App\Modules\Kagi\Http\Domain\Models\User;

use Auth;
use Config;
use DateTime;
use DB;
use Eloquent;
use Hash;

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
	 * @param  App\Modules\Kagi\Http\Domain\Models\Role $role
	 * @param  App\Modules\Kagi\Http\Domain\Models\User $user
	 * @return void
	 */
	public function __construct(
		Role $role,
		shinobiRole $shinobiRole,
		User $user
		)
	{
		$this->role = $role;
		$this->shinobiRole = $shinobiRole;
		$this->user = $user;
	}

	/**
	 * Get user collection.
	 *
	 * @param  string  $slug
	 * @return Illuminate\Support\Collection
	 */
	public function show($id)
	{
		$user = $this->user->findOrFail($id);
//dd($user);
		$roles = $this->getRoles();
//dd($roles);
		$allRoles =  $this->role->all()->lists('name', 'id');
//dd($allRoles);

		return compact('user', 'roles', 'allRoles');
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
		$roles = $user->roles->lists('name', 'id');
//		$roles = $this->shinobiRole->lists('name', 'id');
		$allRoles =  $this->role->all()->lists('name', 'id');
//dd($roles);
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

		if ( $input['password'] != null ) {
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
			$user->activated_at = null;
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
//dd($this->shinobiRole->lists('name'));

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
//	protected $fillable = ['name', 'email', 'password', 'blocked', 'banned', 'confirmed', 'activated', "avatar'];
//dd($userData->email);

		if ($userData->name == null) {
			$userData->name = $userData->nickname;
		}
		if ($userData->email == null) {
			$userData->email = $userData->nickname;
		}
		if ($userData->avatar == null) {
			$userData->avatar = Config::get('kagi.kagi_avatar', 'assets/images/usr.png');
		}
		$date = date("Y-m-d H:i:s");

		$name							= $userData->name;
		$email							= $userData->email;
		$avatar							= $userData->avatar;

		$check = $this->checkUserExists($name, $email);
		if ($check == null) {
			User::create([
				'name'					=> $name,
				'email'					=> $email,
				'avatar'				=> $avatar,
				'blocked'				=> 0,
				'banned'				=> 0,
				'confirmed'				=> 1,
				'activated'				=> 1,
				'activated_at'			=> $date,
				'last_login'			=> $date,
				'avatar'				=> $avatar,
				'confirmation_code'		=> md5(microtime().Config::get('app.key'))
			]);

			$check_again = $this->checkUserExists($name, $email);
//dd($check_again->id);
			$user = $this->user->find($check_again->id);
			$user->syncRoles([Config::get('kagi.default_role')]);

			\Event::fire(new \ProfileWasCreated($check_again));
			\Event::fire(new \EmployeeWasCreated($check_again));

			return $user;

		} else {
//dd($check);
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

		if ($userData->name == null) {
			$userData->name = $userData->nickname;
		}
		if ($userData->email == null) {
			$userData->email = $userData->nickname;
		}
		if ($userData->avatar == null) {
			$userData->avatar = Config::get('kagi.kagi_avatar', 'assets/images/usr.png');
		}
		$date = date("Y-m-d H:i:s");

		$name							= $userData->name;
		$email							= $userData->email;
		$avatar							= $userData->avatar;

		$check = $this->checkUserExists($name, $email);
//dd($check);
		if ($check == null) {
			User::firstOrCreate([
				'name'					=> $name,
				'email'					=> $email,
				'avatar'				=> $avatar,
				'activated_at'			=> date("Y-m-d H:i:s"),
				'blocked'				=> 0,
				'banned'				=> 0,
				'confirmed'				=> 1,
				'activated'				=> 1,
				'activated_at'			=> $date,
				'last_login'			=> $date,
				'avatar'				=> $avatar,
				'confirmation_code'		=> md5(microtime().Config::get('app.key'))
			]);

			$check_again = $this->checkUserExists($name, $email);
//dd($check_again->id);
			$user = $this->user->find($check_again->id);
			$user->syncRoles([Config::get('kagi.default_role')]);

			\Event::fire(new \ProfileWasCreated($check_again));
			\Event::fire(new \EmployeeWasCreated($check_again));

			return User::firstOrCreate([
				'name'					=> $name,
				'email'					=> $email,
			]);

		} else {
//dd($check);
			$this->touchLastLogin($check->id);

			return User::firstOrCreate([
				'name'					=> $name,
				'email'					=> $email,
			]);
		}
	}


}
