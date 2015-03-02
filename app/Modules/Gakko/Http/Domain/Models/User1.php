<?php
namespace App\Modules\Gakko\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Kagi\Http\Domain\Models\User;

class User1 extends App\Modules\Kagi\Http\Domain\Models\User {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

// DEFINE Fillable -------------------------------------------------------


// DEFINE Relationships --------------------------------------------------
	public function profile()
	{
		return $this->hasOne('App\Modules\Profiles\Http\Domain\Models\Profile');
	}


}
