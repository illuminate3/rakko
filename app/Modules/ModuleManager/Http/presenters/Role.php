<?php namespace App\Modules\ModuleManager\Http\Presenters;

use Laracasts\Presenter\Presenter;

class MMRolePresenter extends Presenter {

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
	public function active()
	{
		return $this->entity->active ? trans('lingos::general.yes') : trans('lingos::general.no');
	}

}
