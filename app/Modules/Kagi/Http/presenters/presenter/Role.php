<?php namespace Vedette\helpers\presenters\presenter;

use Vedette\helpers\presenters\Presenter;

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
