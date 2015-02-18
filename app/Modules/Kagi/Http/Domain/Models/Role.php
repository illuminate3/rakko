<?php namespace App\Modules\Kagi\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;

use Laracasts\Presenter\PresentableTrait;
use Caffeinated\Shinobi\Traits\ShinobiTrait;

class Role extends Model {

	use PresentableTrait, ShinobiTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'roles';

	protected $presenter = 'App\modules\Kagi\Http\Presenters\Role';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
//	protected $hidden = ['password', 'remember_token'];

	protected $fillable = ['name', 'slug', 'description'];


// DEFINE Relationships --------------------------------------------------
	public function user()
	{
		return $this->hasMany('App\Modules\Kagi\Http\Domain\Models\User');
	}



}
