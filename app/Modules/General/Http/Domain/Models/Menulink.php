<?php
namespace App\Modules\General\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;

use Laracasts\Presenter\PresentableTrait;
use Vinkla\Translator\Translatable;
use Vinkla\Translator\Contracts\Translatable as TranslatableContract;

class Menulink extends Model implements TranslatableContract {

	use Translatable;
	use PresentableTrait;

	protected $table = 'menulinks';

// Presenter -------------------------------------------------------
	protected $presenter = 'App\Modules\General\Http\Presenters\General';


// Translation Model -------------------------------------------------------
	protected $translator = 'App\Modules\General\Http\Domain\Models\MenulinkTranslation';


// DEFINE Hidden -------------------------------------------------------
	protected $hidden = [
		'created_at',
		'updated_at'
		];


// DEFINE Fillable -------------------------------------------------------
	protected $fillable = [
		'menu_id',
		'page_id',
		'parent_id',
		'position',
		'target',
		'restricted_to',
		'class',
		'icon_class',
		'link_type',
		'has_categories',
		// Translatable columns
		'title',
		'status',
		'url'
		];


// Translated Columns -------------------------------------------------------
	protected $translatedAttributes = [
		'title',
		'status',
		'url'
		];

// 	protected $appends = [
// 		'title',
// 		'status',
// 		'url'
// 		];

	public function getStatusAttribute()
	{
		return $this->status;
	}

	public function getTitleAttribute()
	{
		return $this->title;
	}

	public function getUrlAttribute()
	{
		return $this->url;
	}


}
