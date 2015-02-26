<?php
namespace App\Modules\Manager\Http\Presenters;

use Laracasts\Presenter\Presenter;

use DB;

class Module extends Presenter {

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


	/**
	 * Present the active field
	 *
	 * @return string
	 */
	public function enabled()
	{
		return $this->entity->enabled ? 'Empty' : 'Full';
//		return $this->entity->enabled ? trans('lingos::general.yes') : trans('lingos::general.no');
	}

	/**
	 * blocked checkbox
	 *
	 * @return string
	 */
	public function enabledCheck()
	{
//dd("loaded");
		$return = '';
		$enabled = $this->entity->enabled;
		if ( $enabled == 1 ) {
			$return = "checked";
		}

		return $return;
	}


}
