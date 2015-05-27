<?php
namespace App\Modules\General\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;
// use Laracasts\Presenter\PresentableTrait;
// use Dimsav\Translatable\Translatable;



class MenuTranslation extends Model {

// use Historable;
// 	use Translatable;
// 	use PresentableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'menu_translations';

// 	protected $presenter = 'App\Modules\General\Http\Presenters\General';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
//	protected $hidden = ['password', 'remember_token'];


// 	public $translatedAttributes = [
// 		'title',
// 		'status',
// 		];

// protected $appends = ['status', 'title'];


// DEFINE Fillable -------------------------------------------------------
/*
			$table->string('name',100)->index();
			$table->string('description')->nullable();
*/
	protected $fillable = [
// 		'name',
// 		'class',
// 		// Translatable columns
// 		'title',
// 		'status',
		];

// DEFINE Relationships --------------------------------------------------

//	public function owner()
	public function menu()
	{
		return $this->belongsTo('App\Modules\General\Http\Domain\Models\Menu', 'menu_id');
	}


}
