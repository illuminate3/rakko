<?php
namespace App\Modules\Manager\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Module extends Model {

	use PresentableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'modules';

	protected $presenter = 'App\Modules\Manager\Http\Presenters\Module';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
//	protected $hidden = ['password', 'remember_token'];

// DEFINE Fillable -------------------------------------------------------
/*
"name": "Manager",
"slug": "Manager",
"version": "1.0",
"description": "This is the description for the Manager module.",
"enabled": true
*/
	protected $fillable = [
		'id',
		'name',
		'slug',
		'version',
		'description',
		'enabled'
		];


// DEFINE Relationships --------------------------------------------------


}
