<?php
namespace App\Modules\General\Http\Presenters;

use Laracasts\Presenter\Presenter;

use Config;
use DB;
use Session;

class General extends Presenter {


	/**
	 * Present the name
	 *
	 * @return string
	 */
	public function name()
	{
		return ucwords($this->entity->name);
	}

	public function checked()
	{
//dd("loaded");
		$return = '';
		$activated = $this->entity->activated;
		if ( $activated == 1 ) {
			$return = "checked";
		}

		return $return;
	}

	public function status($status)
	{
//dd($status);

		$return = trans('kotoba::general.enabled');
		if ( $status == 0 ) {
			$return = trans('kotoba::general.disabled');
		}

		return $return;
	}

	public function menuName($id)
	{
		$locale = Session::get('locale', Config::get('app.locale'));
		$locale_id = DB::table('locales')
			->where('locale', '=', $locale)
			->pluck('id');
//dd($locale_id);

		$name = DB::table('menu_translations')
			->where('id', '=', $id)
			->where('locale_id', '=', $locale_id, 'AND')
			->pluck('title');
		return $name;

	}

}
