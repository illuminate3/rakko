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

    public function menuclass()
    {
        return $this->entity->menuclass;
    }
    public function title()
    {
        return $this->entity->name;
    }

}
