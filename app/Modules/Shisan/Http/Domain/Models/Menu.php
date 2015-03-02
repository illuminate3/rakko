<?php
namespace App\Modules\Gakko\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Menu extends Model {

	use PresentableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
//	protected $table = 'rooms';

	protected $presenter = 'App\Modules\Gakko\Http\Presenters\Category';

	private $menus;


    /**
     * The set of characters for testing slugs.
     *
     * @var  string
     */
//    public static $slugPattern = '[a-z0-9\-/]+';

//	protected $fillable = array('slug', 'title', 'body', 'parent_id');

//    protected $visible = array('title', 'slug', 'body', 'children');

// DEFINE Relationships --------------------------------------------------
/*
	public function page()
	{
		return $this->belongsTo('Page');
	}
*/

}
