<?php
namespace App\Modules\General\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Dimsav\Translatable\Translatable;

// use Illuminate\Database\Eloquent\Builder;
// use InvalidArgumentException;
// use Laracasts\Presenter\PresentableTrait;
// use Log;
// use TypiCMS\Modules\Core\Models\Base;
// use TypiCMS\Modules\History\Traits\Historable;
// use TypiCMS\NestableTrait;


class Menulink extends Model {

// use Historable;
	use Translatable;
	use PresentableTrait;
//	use NestableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'menulinks';

	protected $presenter = 'App\Modules\General\Http\Presenters\General';


	public $translatedAttributes = [
		'title',
		'status',
		'url'
		];

	protected $appends = [
		'title',
		'status'
		];


// DEFINE Fillable -------------------------------------------------------
/*
			$table->string('name',100)->index();
			$table->string('description')->nullable();
*/
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

// DEFINE Relationships --------------------------------------------------

	public function menu()
	{
		return $this->belongsTo('App\Modules\General\Http\Domain\Models\Menu');
	}



//     /**
//      * A menulink can belongs to a page
//      */
//     public function page()
//     {
//         return $this->belongsTo('TypiCMS\Modules\Pages\Models\Page');
//     }
//
//     /**
//      * A menulink can have children
//      */
//     public function children()
//     {
//         return $this->hasMany('TypiCMS\Modules\Menulinks\Models\Menulink', 'parent_id');
//     }
//
//     /**
//      * A menulink can have a parent
//      */
//     public function parent()
//     {
//         return $this->belongsTo('TypiCMS\Modules\Menulinks\Models\Menulink', 'parent_id');
//     }
//
//     /**
//      * Get edit url of model
//      *
//      * @return string|void
//      */
//     public function editUrl()
//     {
//         try {
//             return route('admin.menus.menulinks.edit', [$this->menu_id, $this->id]);
//         } catch (InvalidArgumentException $e) {
//             Log::error($e->getMessage());
//         }
//     }
//
//     /**
//      * Get back office’s index of models url
//      *
//      * @return string|void
//      */
//     public function indexUrl()
//     {
//         try {
//             return route('admin.menus.edit', $this->menu_id);
//         } catch (InvalidArgumentException $e) {
//             Log::error($e->getMessage());
//         }
//     }


// Functions --------------------------------------------------


}
