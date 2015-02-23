<?php
namespace App\Modules\Gakko\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Site extends Model {

	use PresentableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sites';

	protected $presenter = 'App\modules\Gakko\Http\Presenters\School';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
//	protected $hidden = ['password', 'remember_token'];

// DEFINE Fillable -------------------------------------------------------
/*
			$table->string('name',100)->index();
			$table->string('email',100)->nullable();
			$table->string('phone_1',20)->nullable();
			$table->string('phone_2',20)->nullable();
			$table->string('website',100)->nullable();
			$table->string('address',100)->nullable();
			$table->string('city',100)->nullable();
			$table->string('state',60)->nullable();
			$table->string('zipcode',20)->nullable();
			$table->string('logo',100)->nullable();

			$table->integer('user_id')->default(1);
			$table->integer('division_id')->nullable();
			$table->string('ad_code',10)->nullable();
			$table->string('bld_number',10)->nullable();

			$table->integer('status_id')->default(1);

			$table->text('notes')->nullable();
*/
	protected $fillable = [
		'id',
		'name',
		'email',
		'phone_1',
		'phone_2',
		'website',
		'address',
		'city',
		'state',
		'zipcode',
		'logo',
		'user_id',
		'ad_code',
		'bld_number',
		'status_id',
		'notes'
		];

// DEFINE Relationships --------------------------------------------------
public function profiles()
{
	return $this->belongsToMany('App\Modules\Gakko\Http\Domain\ModelsProfile');
}
/*
public function profile()
{
	return $this->belongsTo('App\Modules\Gakko\Http\Domain\ModelsProfile');
}
*/

public function division()
{
	return $this->belongsTo('App\Modules\Gakko\Http\Domain\ModelsDivision');
}

public function user()
{
	return $this->belongsTo('User');
}
public function users()
{
	return $this->hasMany('User');
}


}
