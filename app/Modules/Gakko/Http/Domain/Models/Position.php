<?php
namespace App\Modules\Gakko\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Position extends Model {

	use PresentableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'positions';

	protected $presenter = 'App\Modules\Gakko\Http\Presenters\School';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
//	protected $hidden = ['password', 'remember_token'];

// DEFINE Fillable -------------------------------------------------------
/*
			$table->string('name',100)->index();
			$table->string('description')->nullable();
*/
	protected $fillable = [
		'id',
		'name',
		'description'
		];

// DEFINE Relationships --------------------------------------------------
public function profiles()
{
	return $this->hasMany('App\Modules\Gakko\Http\Domain\Models\Profile');
}


}
