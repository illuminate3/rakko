<?php namespace App\modules\Kagi\Http\Presenters;

use Laracasts\Presenter\Presenter;

class User extends Presenter {

//dd('loaded');


	/**
	 * name
	 *
	 * @return string
	 */
	public function name()
	{
		return ucwords($this->entity->name);
	}

	/**
	 * email
	 *
	 * @return string
	 */
	public function email()
	{
		return $this->entity->email;
	}

	/**
	 * banned checkbox
	 *
	 * @return string
	 */
	public function banned()
	{
//dd("loaded");
		$return = '';
//		return $this->entity->active ? trans('lingos::general.yes') : trans('lingos::general.no');

		$banned = $this->entity->banned;
		if ( $banned == 1 ) {
			$return = "checked";
		}

		return $return;
	}

	/**
	 * verified checkbox
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
	 * confirmed checkbox
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
	 * activated checkbox
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
	 * banned icon
	 *
	 * @return string
	 */
	public function iconBanned()
	{
//dd("loaded");
		$return = '';
		$banned = $this->entity->banned;

		if ( $banned == 1 ) {
			$return = '<span class="glyphicon glyphicon-ok text-success"></span>';
		} else {
			$return = '<span class=\'glyphicon glyphicon-remove text-danger\'></span>';
		}

		return $return;
	}

	/**
	 * verified icon
	 *
	 * @return string
	 */
	public function iconVerified()
	{
//dd("loaded");
		$return = '';
		$verified = $this->entity->verified;

		if ( $verified == 1 ) {
			$return = '<span class="glyphicon glyphicon-ok text-success"></span>';
		} else {
			$return = '<span class=\'glyphicon glyphicon-remove text-danger\'></span>';
		}

		return $return;
	}

	/**
	 * confirmed icon
	 *
	 * @return string
	 */
	public function iconConfirmed()
	{
//dd("loaded");
		$return = '';
		$confirmed = $this->entity->confirmed;

		if ( $confirmed == 1 ) {
			$return = '<span class="glyphicon glyphicon-ok text-success"></span>';
		} else {
			$return = '<span class=\'glyphicon glyphicon-remove text-danger\'></span>';
		}

		return $return;
	}

	/**
	 * activated icon
	 *
	 * @return string
	 */
	public function iconActivated()
	{
//dd("loaded");
		$return = '';
		$activated = $this->entity->activated;

		if ( $activated == 1 ) {
			$return = '<span class="glyphicon glyphicon-ok text-success"></span>';
		} else {
			$return = '<span class=\'glyphicon glyphicon-remove text-danger\'></span>';
		}

		return $return;
	}

	/**
	 * roles
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
