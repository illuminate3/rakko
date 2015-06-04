<?php
namespace App\Modules\General\Http\Domain\Typi\Facades;

use Illuminate\Support\Facades\Facade as Facade;

class TypiFacade extends Facade
{


	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
//dd('here');
//		return 'menus';
		return 'App\Modules\General\Http\Domain\Typi\Menus\LinkerInterface';
	}


}
