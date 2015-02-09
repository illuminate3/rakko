<?php namespace App\Modules\Kagi\Http\Domain;

use Illuminate\Database\Eloquent\Model;

//use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Laracasts\Presenter\PresentableTrait;

class Role extends Model {

//	use ShinobiTrait, PresentableTrait;
	use PresentableTrait;

	protected $fillable = [];

}
