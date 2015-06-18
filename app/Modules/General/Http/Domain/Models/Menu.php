<?php
namespace App\Modules\General\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;

use Laracasts\Presenter\PresentableTrait;
use Vinkla\Translator\Translatable;
use Vinkla\Translator\Contracts\Translatable as TranslatableContract;

class Menu extends Model implements TranslatableContract {

	use Translatable;
	use PresentableTrait;

	protected $table = 'menus';

// Presenter -------------------------------------------------------
	protected $presenter = 'App\Modules\General\Http\Presenters\General';


// Translation Model -------------------------------------------------------
	protected $translator = 'App\Modules\General\Http\Domain\Models\MenuTranslation';


// DEFINE Hidden -------------------------------------------------------
	protected $hidden = [
		'created_at',
		'updated_at'
		];


// DEFINE Fillable -------------------------------------------------------
	protected $fillable = [
		'class',
		'name',
		// Translatable columns
		'status',
		'title'
		];


// Translated Columns -------------------------------------------------------
	protected $translatedAttributes = [
		'status',
		'title'
		];

// 	protected $appends = [
// 		'status',
// 		'title'
// 		];

	public function getStatusAttribute()
	{
		return $this->status;
	}

	public function getTitleAttribute()
	{
		return $this->title;
	}


}
