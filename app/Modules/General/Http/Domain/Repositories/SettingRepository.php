<?php
namespace App\Modules\General\Http\Domain\Repositories;

use App\Modules\General\Http\Domain\Models\Setting;

use DB;
use Registry;


class SettingRepository extends BaseRepository {


	/**
	 * The Module instance.
	 *
	 * @var App\Modules\ModuleManager\Http\Domain\Models\Module
	 */
	protected $setting;

	/**
	 * Create a new ModuleRepository instance.
	 *
   	 * @param  App\Modules\ModuleManager\Http\Domain\Models\Module $module
	 * @return void
	 */
	public function __construct(
		Setting $setting
		)
	{
		$this->model = $setting;
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
		$setting = $this->model->find($id);
//dd($module);

		return compact('setting');
	}

	/**
	 * Get user collection.
	 *
	 * @param  int  $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit($key)
	{
//dd($key);
//		$setting = $this->model->find($key);
		$setting = $this->getKeyValues($key);
//dd($setting);

		return compact('setting');
	}

	/**
	 * Get all models.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function store($input)
	{
// 		$this->model = new Setting;
// 		$this->model->create($input);
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
		$setting = Setting::find($id);
		$setting->update($input);
	}


	public function getKeyValues($key)
	{

		$values = DB::table('settings')
			->where('key', '=', $key)
			->first();

		return $values;
	}


}
