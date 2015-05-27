<?php
namespace App\Modules\General\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;



class Menu extends Model {

// use Historable;
// use Translatable;
	use PresentableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'menus';

	protected $presenter = 'App\Modules\General\Http\Presenters\General';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
//	protected $hidden = ['password', 'remember_token'];


// public $translatedAttributes = array(
// 'title',
// 'status',
// );
//
// protected $appends = ['status', 'title'];


// DEFINE Fillable -------------------------------------------------------
/*
			$table->string('name',100)->index();
			$table->string('description')->nullable();
*/
	protected $fillable = [
		'name',
		'class',
		// Translatable columns
		'title',
		'status',
		];

// DEFINE Relationships --------------------------------------------------

	public function menulinks()
	{
		return $this->hasMany('App\Modules\General\Http\Domain\Models\\Menulink')->orderBy('position', 'asc');
	}


}
