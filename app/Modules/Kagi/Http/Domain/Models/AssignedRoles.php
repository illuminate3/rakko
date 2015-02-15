<?php namespace App\Modules\Kagi\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;

//use Laracasts\Presenter\PresentableTrait;

class AssignedRoles extends Model {

//	use PresentableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'assigned_roles';

//	protected $presenter = 'App\modules\Kagi\Http\Presenters\Role';

	protected $fillable = [];


}
