<?php
namespace App\Modules\General\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Setting extends Model {

	use PresentableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'settings';

	protected $presenter = 'App\Modules\General\Http\Presenters\General';

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
// 		'id',
// 		'name',
// 		'description'
		];

// DEFINE Relationships --------------------------------------------------


}
