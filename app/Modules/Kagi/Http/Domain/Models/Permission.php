<?php
namespace App\Modules\Kagi\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;

use Laracasts\Presenter\PresentableTrait;

class Permission extends Model {

	use PresentableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'permissions';

	protected $presenter = 'App\modules\Kagi\Http\Presenters\Permission';

//	protected $hidden = ['_token'];

// DEFINE Fillable -------------------------------------------------------
	protected $fillable = ['name', 'slug', 'description'];


// DEFINE Relationships --------------------------------------------------


}
