<?php
namespace App\Modules\General\Http\Presenters;

use Laracasts\Presenter\Presenter;

use DB;

class Site extends Presenter {

	/**
	 * Present the name
	 *
	 * @return string
	 */
	public function name()
	{
		return ucwords($this->entity->name);
	}













	/**
	 * Present the profiles
	 *
	 * @return string
	 */
	public function profiles()
	{
		$return   = '';
		$profiles = $this->entity->profiles;
//dd($profiles);

		if (empty($profiles)) {
			$return = trans('lingos::general.none');
		} else {
			foreach ($profiles as $profile) {
//				$return .= $site->present()->name() . ',&nbsp;';
				$return .= $profile->first_name . ',<br>';
			}
		}
	}


	/**
	 * Present the active field
	 *
	 * @return string
	 */
	public function active()
	{
		return $this->entity->active ? trans('lingos::general.yes') : trans('lingos::general.no');
	}

}
