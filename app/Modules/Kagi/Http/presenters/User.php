<?php namespace App\modules\Kagi\Http\Presenters;

use Laracasts\Presenter\Presenter;

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
	 * Present the email
	 *
	 * @return string
	 */
	public function banned()
	{
//dd("loaded");
		$return = '';
		$banned = $this->entity->banned;
		if ( $banned == 1 ) {
			$return = "checked";
		}

		return $return;
	}

	/**
	 * Present the email
	 *
	 * @return string
	 */
	public function verified()
	{
//dd("loaded");
		$return = '';
		$verified = $this->entity->verified;
		if ( $verified == 1 ) {
			$return = "checked";
		}

		return $return;
	}

	/**
	 * Present the email
	 *
	 * @return string
	 */
	public function confirmed()
	{
//dd("loaded");
		$return = '';
		$confirmed = $this->entity->confirmed;
		if ( $confirmed == 1 ) {
			$return = "checked";
		}

		return $return;
	}

	/**
	 * Present the email
	 *
	 * @return string
	 */
	public function activated()
	{
//dd("loaded");
		$return = '';
		$activated = $this->entity->activated;
		if ( $activated == 1 ) {
			$return = "checked";
		}

		return $return;
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
			$return .= $role->present()->name() . ', ';
		}

		if (empty($return))
		{
			$return = trans('lingos::general.none');
		}

		return trim($return, ', ');
	}

}
