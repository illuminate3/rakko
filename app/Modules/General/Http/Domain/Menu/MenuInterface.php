<?php
namespace App\Modules\General\Http\Domain\Menu;

use App\Modules\General\Http\Domain\Menu\RepositoryInterface;

/**
 * Interface MenuInterface
 * @package Fully\Repositories\Menu
 * @author Sefa Karagöz
 */
interface MenuInterface {


	/**
	 * Get al data
	 * @return mixed
	 */
	public function all();


}
