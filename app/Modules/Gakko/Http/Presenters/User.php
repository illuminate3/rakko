<?php namespace HR\helpers\presenters\presenter;

use HR\helpers\presenters\Presenter;

class User extends Presenter {

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
	 * Present the email
	 *
	 * @return string
	 */
	public function email()
	{
		return $this->entity->email;
	}

	/**
	 * Present the roles
	 *
	 * @return string
	 */
	public function roles()
	{
		$roles = $this->entity->roles;
		$return = '';
//dd($roles);
		foreach ($roles as $role)
		{
			$return .= $role->present()->name() . ',&nbsp;';
		}

		if (empty($return))
		{
			$return = trans('lingos::general.none');
		}

		return trim($return, ',&nbsp;');
	}

}
