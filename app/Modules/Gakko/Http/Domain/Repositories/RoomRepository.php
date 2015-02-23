<?php
namespace App\Modules\Gakko\Http\Domain\Repositories;

use App\Modules\Gakko\Http\Domain\Models\Room;

use DB;
//use Hash, DB, Auth;
//use DateTime;
//use File, Auth;

class RoomRepository extends BaseRepository {

	/**
	 * The Module instance.
	 *
	 * @var App\Modules\ModuleManager\Http\Domain\Models\Module
	 */
	protected $room;

	/**
	 * Create a new ModuleRepository instance.
	 *
   	 * @param  App\Modules\ModuleManager\Http\Domain\Models\Module $module
	 * @return void
	 */
	public function __construct(
		Room $room
		)
	{
		$this->model = $room;
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
		$room = $this->model->find($id);
//dd($module);

		return compact('room');
	}

	/**
	 * Get user collection.
	 *
	 * @param  int  $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit($id)
	{
		$room = $this->model->find($id);
//dd($module);

		return compact('room');
	}

	/**
	 * Get all models.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function store($input)
	{
//dd($input);
		$this->model = new Room;
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
		$room = Room::find($id);
		$room->update($input);
	}


}
