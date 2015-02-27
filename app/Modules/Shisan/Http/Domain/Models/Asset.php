<?php
namespace App\Modules\Gakko\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Asset extends Model {

	use PresentableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'assets';

	protected $presenter = 'App\Modules\Gakko\Http\Presenters\Site';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	protected $guarded = array();



// DEFINE Rules --------------------------------------------------
	public static $rules = array(
/*

		'item_id' => 'required',
		'site_id' => 'required',
		'room' => 'required',
		'statuses_tech_id' => 'required',
		'asset_tag' => 'required',
		'serial' => 'required',
		'po' => 'required',
		'note' => 'required'

*/
	);

	public static $rulesUpdate = array(
/*

		'item_id' => 'required',
		'site_id' => 'required',
		'room' => 'required',
		'statuses_tech_id' => 'required',
		'asset_tag' => 'required',
		'serial' => 'required',
		'po' => 'required',
		'note' => 'required'

*/
	);


// DEFINE Fillable --------------------------------------------------
	protected $fillable = [];


// DEFINE Relationships --------------------------------------------------

public function items()
{
	return $this->belongsToMany('Item', 'asset_item', 'asset_id', 'item_id');
}

public function rooms()
{
	return $this->belongsToMany('Room', 'asset_room', 'asset_id', 'room_id');
}

public function sites()
{
	return $this->belongsToMany('Site', 'asset_site', 'asset_id', 'site_id');
}

public function users()
{
	return $this->belongsToMany('User', 'asset_user', 'asset_id', 'user_id');
}


}
