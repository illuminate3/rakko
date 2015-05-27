<?php
namespace App\Modules\General\Http\Domain\Repositories;

use App\Modules\General\Http\Domain\Models\Menu;

use App;
use DB;
use Session;
//use Hash, DB, Auth;
//use DateTime;
//use File, Auth;

class MenuRepository extends BaseRepository {

	/**
	 * The Module instance.
	 *
	 * @var App\Modules\ModuleManager\Http\Domain\Models\Module
	 */
	protected $menu;

	/**
	 * Create a new ModuleRepository instance.
	 *
   	 * @param  App\Modules\ModuleManager\Http\Domain\Models\Module $module
	 * @return void
	 */
	public function __construct(
		Menu $menu
		)
	{
		$this->model = $menu;
	}

	/**
	 * Get role collection.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function create()
	{
		$lang = Session::get('locale');
		$locales = $this->getLocales();
//dd($locales);

		return compact('locales', 'lang');
	}

	/**
	 * Get user collection.
	 *
	 * @param  string  $slug
	 * @return Illuminate\Support\Collection
	 */
	public function show($id)
	{
		$menu = $this->model->find($id);
//dd($module);

		return compact('menu');
	}

	/**
	 * Get user collection.
	 *
	 * @param  int  $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit($id)
	{
		$menu = $this->model->find($id);
		$lang = Session::get('locale');
		$locales = $this->getLocales();
//dd($locales);

		return compact('menu', 'locales', 'lang');
	}

	/**
	 * Get all models.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function store($input)
	{
//dd($input);
		$this->model = new Menu;
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
		$menu = Menu::find($id);
		$menu->update($input);
	}


	public function getLocales()
	{

		$config = App::make('config');
//		$locales = (array) $config->get('translatable.locales', []);
		$locales = (array) $config->get('languages.supportedLocales', []);

	if ( empty($locales) ) {
		throw new LocalesNotDefinedException('Please make sure you have run "php artisan config:publish dimsav/laravel-translatable" ' . ' and that the locales configuration is defined.');
	}

	return $locales;
	}


}
