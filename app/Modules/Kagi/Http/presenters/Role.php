<?php
namespace App\modules\Kagi\Http\Presenters;

use Laracasts\Presenter\Presenter;

class Role extends Presenter {

	/**
	 * Present the name
	 *
	 * @return string
	 */
	public function name()
	{
		return ucwords($this->entity->name);
	}

}
