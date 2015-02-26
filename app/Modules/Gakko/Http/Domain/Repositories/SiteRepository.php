<?php
namespace App\Modules\Gakko\Http\Domain\Repositories;

use App\Modules\Gakko\Http\Domain\Models\Site;

use Config, DB, Lang;
//use Hash, DB, Auth;
//use DateTime;
//use File, Auth;
use Image;

class SiteRepository extends BaseRepository {

	/**
	 * The Module instance.
	 *
	 * @var App\Modules\ModuleManager\Http\Domain\Models\Module
	 */
	protected $site;

	/**
	 * Create a new ModuleRepository instance.
	 *
   	 * @param  App\Modules\ModuleManager\Http\Domain\Models\Module $module
	 * @return void
	 */
	public function __construct(
		Site $site
		)
	{
		$this->model = $site;
	}

	/**
	 * Get role collection.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function create()
	{
		$divisions = $this->getDivisions();
		$divisions = array('' => trans('kotoba::general.command.select_a') . '&nbsp;' . Lang::choice('kotoba::hr.division', 1)) + $divisions;

		$contacts = $this->getContacts();
		$contacts = array('' => trans('kotoba::general.command.select_a') . '&nbsp;' . trans('kotoba::general.contact')) + $contacts;

		$statuses = $this->getStatuses();
		$statuses = array('' => trans('kotoba::general.command.select_a') . '&nbsp;' . trans('kotoba::general.status')) + $statuses;

		return compact('divisions', 'contacts', 'statuses');
	}

	/**
	 * Get user collection.
	 *
	 * @param  string  $slug
	 * @return Illuminate\Support\Collection
	 */
	public function show($id)
	{
		$site = $this->model->find($id);
//dd($site->logo);
//dd(Image::make(public_path() . '/uploads/uni.png')->response());
//dd(time());
//dd( Config::get('general.image.logo_show') );


		if ($site->logo != NULL) {
//			$logo = Image::getPaths($site->logo);
// 			$logo = Image::make('uploads/logos/'. $site->logo)->encode('data-url');
			$logo = $site->logo;
		} else {
			$logo = null;
		}
//dd($logo);
/*
$url = 'uploads/logos/'. $site->logo;
$img = Image::cache(function($image) use ($url) {
    return $image->make($url)->fit(350, 300)->encode('data-url');
},10, false);
//dd($img);
*/
//$img =  Image::make('uploads/uni.png')->resize(300, 200)->greyscale();
$img = '';
		return compact('site', 'logo', 'img');
	}

	/**
	 * Get user collection.
	 *
	 * @param  int  $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit($id)
	{
		$site = $this->model->find($id);
//dd($module);

		$divisions = $this->getDivisions();
		$divisions = array('' => trans('kotoba::general.command.select_a') . '&nbsp;' . Lang::choice('kotoba::hr.division', 1)) + $divisions;

		$contacts = $this->getContacts();
		$contacts = array('' => trans('kotoba::general.command.select_a') . '&nbsp;' . trans('kotoba::general.contact')) + $contacts;

		$statuses = $this->getStatuses();
		$statuses = array('' => trans('kotoba::general.command.select_a') . '&nbsp;' . trans('kotoba::general.status')) + $statuses;

		return compact('site', 'divisions', 'contacts', 'statuses');
	}

	/**
	 * Get all models.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function store($input)
	{
//dd($input);
		$this->model = new Site;

// 			$logo = Input::file('logo');
// 			if ($logo) {
// 				$input['logo'] = Image::upload($logo);
// 			} else {
// 				$input['logo'] = '';
// 			}


		$this->model->create($input);


	}

	/**
	 * Update a role.
	 *
	 * @param  array  $inputs
	 * @param  int    $id
	 * @return void
	 */
	public function update($input, $id)
	{
//dd($input['enabled']);
		$site = Site::find($id);
		$site->update($input);
	}


// Functions --------------------------------------------------

	public function getDivisions()
	{
		$divisions = DB::table('divisions')->lists('name', 'id');
		return $divisions;
	}

	public function getContacts()
	{
		$contacts = DB::table('users')->lists('name', 'id');
//		$contacts = DB::table('profiles')->lists('email', 'user_id');
//		$contacts = DB::table('profiles')->lists('first_name' . '&nbsp;' . 'last_name', 'user_id');
// 		if ( empty($contacts) ) {
// 			$contacts = DB::table('users')->lists('email', 'id');
// 		}
		return $contacts;
	}

	public function getStatuses()
	{
		$statuses = DB::table('statuses')->lists('name', 'id');
		return $statuses;
	}

	public function getContactUser($id)
	{
		$user = DB::table('profiles')
			->where('user_id', '=', $id)
			->first();
		return $user;
	}

}
