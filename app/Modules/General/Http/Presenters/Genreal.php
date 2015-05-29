<?php
namespace App\Modules\General\Http\Presenters;

use Laracasts\Presenter\Presenter;

use DB;

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

    public function menuclass()
    {
        return $this->entity->menuclass;
    }
    public function title()
    {
        return $this->entity->name;
    }

}
