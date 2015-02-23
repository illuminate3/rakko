<?php
namespace App\modules\Kagi\Http\Presenters;

use Laracasts\Presenter\Presenter;

class Permission extends Presenter {

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
