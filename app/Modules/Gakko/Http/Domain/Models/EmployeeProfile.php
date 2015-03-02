<?php
namespace App\Modules\Gakko\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Profiles\Http\Domain\Models\Profile;

class EmployeeProfile extends Profile {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'profiles';

// DEFINE Fillable -------------------------------------------------------

// DEFINE Relationships --------------------------------------------------
	public function employee()
	{
		return $this->hasOne('App\Modules\Gakko\Http\Domain\Models\Employee');
	}


}
