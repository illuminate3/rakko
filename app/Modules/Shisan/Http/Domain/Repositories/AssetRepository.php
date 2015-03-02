<?php
namespace App\Modules\Shisan\Http\Domain\Repositories;

class AssetRepository extends BaseRepository {

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
	 * Get role collection.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function create()
	{
//		$allPermissions =  $this->permission->all()->lists('name', 'id');
//dd($allPermissions);

		return compact('');
	}

	/**
	 * Get user collection.
	 *
	 * @param  string  $slug
	 * @return Illuminate\Support\Collection
	 */
	public function show($id)
	{
		$department = $this->model->find($id);
//dd($module);

		return compact('department');
	}

	/**
	 * Get user collection.
	 *
	 * @param  int  $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit($id)
	{
		$department = $this->model->find($id);
//dd($module);

		return compact('department');
	}

	/**
	 * Get all models.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function store($input)
	{
//dd($input);
		$this->model = new Department;
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
		$department = Department::find($id);
		$department->update($input);
	}


// Functions --------------------------------------------------

public function getItems()
{
	$items = DB::table('items')->lists('model', 'id');
	return $items;
}

public function getSites()
{
	$sites = DB::table('sites')->lists('name', 'id');
	return $sites;
}

public function getRooms()
{
	$sites = DB::table('rooms')->lists('name', 'id');
	return $sites;
}

public function getUsers()
{
	$users = DB::table('users')->lists('email', 'id');
	return $users;
}

public function getStatuses()
{
	$statuses = DB::table('asset_statuses')->lists('name', 'id');
	return $statuses;
}


public function attachAsset($id, $item_id)
{
	$item = Asset::find($id);
	$item->items()->attach($item_id);
}
public function detachAsset($id, $item_id)
{
	$item = Asset::find($id)->items()->detach();
}

public function attachSite($id, $site_id)
{
	$item = Asset::find($id);
	$item->sites()->attach($site_id);
}
public function detachSite($id, $site_id)
{
	$item = Asset::find($id)->sites()->detach();
}

public function attachUser($id, $user_id)
{
	$item = Asset::find($id);
	$item->users()->attach($user_id);
}
public function detachUser($id, $user_id)
{
	$item = Asset::find($id)->users()->detach();
}

public function attachRoom($id, $room_id)
{
	$item = Asset::find($id);
	$item->rooms()->attach($room_id);
}
public function detachRoom($id, $room_id)
{
	$item = Asset::find($id)->rooms()->detach();
}



}
