<?php
namespace App\Modules\Shisan\Http\Domain\Repositories;

class ScanRepository extends BaseRepository {

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
	public function getPallet($barcode)
	{
		$pallet = DB::table('pallets')
			->where('barcode', '=', $barcode)
			->get();

		return $pallet;
	}

	public function getRack($barcode)
	{
		$rack = DB::table('racks')
			->where('barcode', '=', $barcode)
			->get();
//dd($rack);
		return $rack;
	}
/*
	public function checkMove($rack_barcode)
	{
		$status = DB::table('racks')
			->where('barcode', '=', $rack_barcode)
			->pluck('status');

		return $status;
	}

	public function movePallet($pallet_id, $rack_barcode)
	{
//dd($rack_barcode);

		$zone = DB::table('racks')
			->where('barcode', '=', $rack_barcode)
			->pluck('zone');
		$rack_id = DB::table('racks')
			->where('barcode', '=', $rack_barcode)
			->pluck('id');
		$zone_id = DB::table('zones')
			->where('name', '=', $zone)
			->pluck('id');
//dd($rack_id);

		$pallet = Pallet::find($pallet_id);
		$pallet->rack_id = $rack_id;
		$pallet->zone_id = $zone_id;
		$pallet->update();

		$rack = Rack::find($rack_id);
		$rack->status = 0;
		$rack->update();
	}
*/

}
