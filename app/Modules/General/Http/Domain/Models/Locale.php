<?php
namespace App\Modules\General\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model {

	/**
	 * @var array
	 */
	protected $fillable = [
		'locale',
		'name',
		'script',
		'native'
		];

}
