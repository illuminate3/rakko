<?php
namespace App\Modules\Shisan\Http\Domain\Repositories;

class ItemRepository extends BaseRepository {

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

public function attachItem($id, $category_id)
{
	$item = Item::find($id);
	$item->categories()->attach($category_id);
}

public function detachItem($id, $category_id)
{
	$item = Item::find($id)->categories()->detach();
}

/*
public function syncItem($id, $category_id)
{
	$item = Item::find($id);

// this is not a proper array
	$item->categories()->sync($category_id);
}
*/

}
