<?php
namespace App\Modules\Gakko\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Scan extends Model {

	use PresentableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'rooms';

	protected $presenter = 'App\Modules\Gakko\Http\Presenters\Site';

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pallets';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	protected $guarded = array();

// DEFINE Rules --------------------------------------------------
	public static $rules = array(
		'barcode' => 'required'
	);
	public static $rulesRack = array(
		'barcode' => 'required'
	);

// DEFINE Fillable --------------------------------------------------
	protected $fillable = array(
/*
		'order_id' => 'required',
		'message' => 'required'
*/
	);

// DEFINE Relationships --------------------------------------------------


}
