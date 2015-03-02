<?php
namespace App\Modules\Gakko\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Item extends Model {

	use PresentableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'rooms';

	protected $presenter = 'App\Modules\Gakko\Http\Presenters\Category';

	protected $guarded = array();

// DEFINE Rules --------------------------------------------------
	public static $rules = array(
/*
		'make' => 'required',
		'model' => 'required',
		'model_number' => 'required',
		'description' => 'required',
//		'image' => 'required'
*/
	);

// DEFINE Fillable --------------------------------------------------


// DEFINE Relationships --------------------------------------------------


public function categories()
{
	return $this->belongsToMany('Category', 'category_item', 'item_id', 'category_id');
}

public function assets()
{
	return $this->belongsToMany('Asset', 'asset_item', 'item_id', 'asset_id');
}

/*
public function assets()
{
	return $this->hasMany('Asset');
}
public function categories()
{
	return $this->belongsToMany('Category');
//	return $this->belongsToMany('Category')->withPivot('category_item');
}

public function assets()
{
	return $this->belongsToMany('Asset');
}
*/


}
