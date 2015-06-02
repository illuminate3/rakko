<?php
namespace App\Modules\General\Http\Domain\Repositories;

use App\Modules\General\Http\Domain\Models\MenuLink;
use Illuminate\Support\Collection;

use App;
use DB;
use Session;
use Lang;

class MenuLinkRepository extends BaseRepository {

	/**
	 * The Module instance.
	 *
	 * @var App\Modules\ModuleManager\Http\Domain\Models\Module
	 */
	protected $menulink;

	/**
	 * Create a new ModuleRepository instance.
	 *
   	 * @param  App\Modules\ModuleManager\Http\Domain\Models\Module $module
	 * @return void
	 */
	public function __construct(
		MenuLink $menulink
		)
	{
		$this->model = $menulink;
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
		$links = MenuLink::all();
//		$links = MenuLink::has('menu')->get();
		$lang = Session::get('locale');
		$locales = $this->getLocales();
//dd($menu);

		return compact('menu', 'links', 'locales', 'lang');
// 		$items = $this->all();
// 		$menus = $this->getMenuHTML($items);
// 		return compact('menu', 'links', 'locales', 'lang', 'items', 'menus');
	}

	/**
	 * Get user collection.
	 *
	 * @param  int  $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit($id)
	{
		$link = $this->model->find($id);
		$lang = Session::get('locale');
		$locales = $this->getLocales();
//dd($menu);
		$menus = $this->getMenus();
		$menus = array('' => trans('kotoba::general.command.select_a') . '&nbsp;' . Lang::choice('kotoba::cms.menu', 1)) + $menus;

		return compact('link', 'locales', 'lang', 'menus');
	}

	/**
	 * Get all models.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function store($input)
	{
//dd($input['menu_id']);
		$this->model = new MenuLink;
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
//dd($input);

		$menu = MenuLink::find($id);
		$menu->update($input);
	}


// Functions --------------------------------------------------

	public function getMenus()
	{
		$sites = DB::table('menus')->lists('name', 'id');
		return $sites;
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


	public function changeParentById($data)
	{
		foreach($data as $k => $v)
		{
			$item = $this->find($v['id']);
			$item->parent_id = $v['parentID'];
			$item->position = $k + 1;
			$item->save();
		}
	}


	public function generateMenu($menu, $parentId = 0) {
		$result = null;
		foreach ($menu as $item)
		{
			if ($item->parent_id == $parentId) {

				$imageName = ($item->is_published) ? "publish_16x16.png" : "not_publish_16x16.png";

				$result .= '
				<li class="dd-item" data-id="' . $item->id . '">
				<button type="button" data-action="collapse">Collapse</button>
				<button type="button" data-action="expand" style="display: none;">Expand</button>
				<div class="dd-handle"></div>
					<div class="dd-content">
						<span>' . $item->title . '</span>
						<div class="ns-actions">
							<a title="Publish Menu" id="' . $item->id . '" class="publish" href="#">
								<img id="publish-image-' . $item->id . '" alt="Publish" src="/assets/images/' . $imageName . '">
							</a>
							<a title="Edit Menu" class="edit-menu" href="admin.menu.edit/' . $item->id . '">
								<img alt="Edit" src="/assets/images/edit.png">
							</a>
							<a class="delete-menu" href="admin.menu.delete/' . $item->id . '">
								<img alt="Delete" src="/assets/images/cross.png">
							</a>
							<input type="hidden" value="1" name="menu_id">
						</div>
				</div>
				' . $this->generateMenu($menu, $item->id) . '</li>';
			}
		}

		return $result ? "\n<ol class=\"dd-list\">\n$result</ol>\n" : null;
	}


	public function getMenuHTML($items)
	{
		return $this->generateMenu($items);
	}


	public function parseJsonArray($jsonArray, $parentID = 0)
	{
//dd($jsonArray);

		$return = array();
		foreach ($jsonArray as $subArray)
		{
dd($subArray);
			$returnSubArray = array();
			if (isset($subArray['children'])) {
				$returnSubArray = $this->parseJsonArray($subArray['children'], $subArray['id']);
			}

			$return[] = array('id' => $subArray['id'], 'parentID' => $parentID);
			$return = array_merge($return, $returnSubArray);
		}

		return $return;
	}


}
