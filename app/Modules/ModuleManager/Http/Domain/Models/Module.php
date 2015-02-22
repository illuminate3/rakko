<?php namespace App\Modules\ModuleManager\Http\Domain\Models;

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

	protected $presenter = 'App\modules\ModuleManager\Http\Presenters\Module';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
//	protected $hidden = ['password', 'remember_token'];

/*
"name": "ModuleManager",
"slug": "ModuleManager",
"version": "1.0",
"description": "This is the description for the ModuleManager module.",
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
