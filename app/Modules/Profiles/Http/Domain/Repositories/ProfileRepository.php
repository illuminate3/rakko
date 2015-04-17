<?php
namespace App\Modules\Profiles\Http\Domain\Repositories;

use App\Modules\Kagi\Http\Domain\Models\User;
use App\Modules\Profiles\Http\Domain\Models\Profile;

use Hash, DB, Auth;
use DateTime;
//use File, Auth;

class ProfileRepository extends BaseRepository {

	/**
	 * The User instance.
	 *
	 * @var App\Modules\Kagi\Http\Domain\Models\User
	 */
	protected $user;

	/**
	 * The Role instance.
	 *
	 * @var App\Modules\Profiles\Http\Domain\Models\Profile
	 */
	protected $profile;

	/**
	 * Create a new UserRepository instance.
	 *
   	 * @param  App\Modules\Kagi\Http\Domain\Models\User $user
	 * @param  App\Modules\Profiles\Http\Domain\Models\Profile $profile
	 * @return void
	 */
	public function __construct(
		User $user,
		Profile $profile
		)
	{
		$this->user = $user;
		$this->profile = $profile;
	}

	/**
	 * Get user collection.
	 *
	 * @param  string  $slug
	 * @return Illuminate\Support\Collection
	 */
	public function show($id)
	{
//		$profile = $this->profile->find($id);
//		$profile = $this->profile->with('user')->find($id);
//		$profile = $this->getProfile($id)->with('user');
//		$profile = $this->getProfile($id);
		$profile = $this->profile->find($id);

dd($id);
		return compact('profile');
	}

	/**
	 * Get user collection.
	 *
	 * @param  int  $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit($id)
	{
		$profile = $this->profile->find($id);
//dd($profile);

		return compact('profile');
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

		if ( $input['password'] != null ) {
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
			$user->activated_at = null;
		}
//dd($user);

		$user->update();

		$user->syncRoles($input['roles']);
	}


	public function checkProfileExists($email)
	{
//dd($email);
		$profile = DB::table('profiles')
			->where('email_1', '=', $email)
			->first();
//dd($profile);

		return $profile;
	}

	/**
	 * @param $data
	 * @return static
	 */
	public function CreateProfile($data)
	{
//dd($data);
		$check = $this->checkProfileExists($data->email);
		if ($check == null) {
//dd($data->id);
			return Profile::create([
				'user_id'						=> $data->id,
				'email_1'						=> $data->email
			]);
		}
	}

	/**
	 * @param $data
	 * @return static
	 */
	public function DeleteProfile($data)
	{
//dd($data);

		$check = $this->checkProfileExists($data->email);
		$profile_id = $this->getProfile($data->id);
//dd($profile_id);

		if ($check != null) {
			$profile = Profile::find($profile_id);
//dd($profile);
			$profile->delete();
			return;
		}
	}

	public function getProfile($id)
	{
		$profile = DB::table('profiles')
			->where('user_id', '=', $id)
			->pluck('id');
//dd($profile);

		return $profile;
	}


}
