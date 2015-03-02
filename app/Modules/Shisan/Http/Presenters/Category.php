<?php
namespace App\Modules\Shisan\Http\Presenters;

use Laracasts\Presenter\Presenter;

use DB;

class Category extends Presenter {

//dd('loaded');

	/**
	 * Present the name
	 *
	 * @return string
	 */
	public function name()
	{
		return ucwords($this->entity->name);
	}

	public function categoryName($id)
	{
		$title = DB::table('categories')
			->where('id', '=', $id)
			->pluck('title');
//dd($customer);

		return $title;
	}


/*
	public function item($id)
	{
		$item = DB::table('catalog')
			->where('id', '=', $id)
			->pluck('name');
//dd($item);
		if ($item == null ) {
			$item = '--- --- --- --- --- ---';
		}
//dd($item);

		return $item;
	}

	public function number($id)
	{
		$number = DB::table('catalog')
			->where('id', '=', $id)
			->pluck('number');
//dd($number);
		if ($number == null ) {
			$number = '--- --- ---';
		}
//dd($number);

		return $number;
	}

	public function location($zone_id, $rack_id)
	{
//dd($zone);
//dd($rack);
		$zone = '';
		$rack = '';
		$location = '';

		if ($zone_id != null ) {
			$zone = DB::table('zones')
				->where('id', '=', $zone_id)
				->pluck('name');
		//dd($zone);

			$location = $zone;
		}
		if ($rack_id != null ) {
			$rack = DB::table('racks')
				->where('id', '=', $rack_id)
				->first();
		//dd($rack);
		//		$racked = $rack->zone . '-' . $rack->aisle . '-' . $rack->level . '-' . $rack->slot;
				$racked = $rack->aisle . '-' . $rack->level . '-' . $rack->slot;

				$location = $zone . '-' . $racked;
		}

		return $location;
	}
*/

}
