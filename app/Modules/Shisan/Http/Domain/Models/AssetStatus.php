<?php
namespace App\Modules\Gakko\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class AssetStatus extends Model {

	use PresentableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'asset_statuses';

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

		'name' => 'required',
		'description' => 'required'

*/
	);

	public static $rulesUpdate = array(
/*

		'name' => 'required',
		'description' => 'required'

*/
	);


// DEFINE Fillable --------------------------------------------------
	protected $fillable = [];


// DEFINE Relationships --------------------------------------------------


// Functions --------------------------------------------------


}
