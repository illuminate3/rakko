<?php
namespace App\Modules\General\Http\Domain\Repositories;

use App\Modules\General\Http\Domain\Models\Locale;
use App\Modules\General\Http\Domain\Models\Menu;
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
		Menu $menu,
		MenuLink $menulink
		)
	{
		$this->menu = $menu;
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
//		$menu = $this->model->find($id);
//		$links = MenuLink::all();
		$links = $this->model->where('menu_id', '=', $id)->get();
//		$links = MenuLink::has('menu')->get();
		$lang = Session::get('locale');
		$locales = $this->getLocales();
//dd($locales);

		return compact(
			'lang',
			'links',
			'locales'
// 			'menu'
			);
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
		$menus = $this->menu->all()->lists('name', 'id');
		$menus = array('' => trans('kotoba::general.command.select_a') . '&nbsp;' . Lang::choice('kotoba::cms.menu', 1)) + $menus;

		return compact(
			'lang',
			'link',
			'locales',
			'menus'
			);
	}

	/**
	 * Get all models.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function store($input)
	{
//dd($input);
// 		$this->model = new MenuLink;
// 		$this->model->create($input);

		$values = [
			'class'			=> $input['class'],
			'menu_id'		=> $input['menu_id'],
			'position'		=> $input['position']
		];

		$menulink = MenuLink::create($values);

		$locales = $this->getLocales();

		foreach($locales as $locale => $properties)
		{
			App::setLocale($properties['locale']);

			if ( !isset($input['status_'.$properties['id']]) ) {
				$status = 0;
			} else {
				$status = $input['status_'.$properties['id']];
			}

			$values = [
				'status'	=> $status,
				'title'		=> $input['title_'.$properties['id']],
				'url'		=> $input['url_'.$properties['id']]
			];

			$menulink->update($values);
		}

		App::setLocale('en');
		return;

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
// 		$menu = MenuLink::find($id);
// 		$menu->update($input);

		$menulink = MenuLink::find($id);

		$values = [
			'class'			=> $input['class'],
			'menu_id'		=> $input['menu_id'],
			'position'		=> $input['position']
		];

		$menulink->update($values);

		$locales = $this->getLocales();

		foreach($locales as $locale => $properties)
		{
			App::setLocale($properties['locale']);

			if ( !isset($input['status_'.$properties['id']]) ) {
				$status = 0;
			} else {
				$status = $input['status_'.$properties['id']];
			}

			$values = [
				'status'	=> $status,
				'title'		=> $input['title_'.$properties['id']],
				'url'		=> $input['url_'.$properties['id']]
			];

			$menulink->update($values);
		}

		App::setLocale('en');
		return $id;

	}


// Functions --------------------------------------------------

// 	public function getMenus()
// 	{
// 		$sites = DB::table('menus')->lists('name', 'id');
// 		return $sites;
// 	}


	public function getLocales()
	{

//		$config = App::make('config');
//		$locales = (array) $config->get('translatable.locales', []);
//		$locales = (array) $config->get('languages.supportedLocales', []);
 		$locales = Locale::all();

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



	// Recursive function that builds the menu from an array or object of items
	// In a perfect world some parts of this function would be in a custom Macro or a View
	public function buildMenu($items, $locale, $parentid = 0)
	{
//dd($items);

		$result = null;

		foreach ($items as $item)
		{
//			if ($item->parent_id == $parentid) {

		$result .= '<li>' . $item->{'title:'.$locale};
		$result .= '<a href="' . $item->url . '">' . $item->{'title:'.$locale} . '</a>';
//		" . $this->buildMenu($items, $item->id)
		$result .= '</li>';

//			}
		}
//dd($result);

			return $result ?  $result : null;


// 		$result .= "<li class='dd-item nested-list-item' data-order='{$item->order}' data-id='{$item->id}'>
// 		<div class='dd-handle nested-list-handle'>
// 		<span class='glyphicon glyphicon-move'></span>
// 		</div>
// 		<div class='nested-list-content'>{$item->label}
// 		<div class='pull-right'>
// 		<a href='".url("admin/menu/edit/{$item->id}")."'>Edit</a> |
// 		<a href='#' class='delete_toggle' rel='{$item->id}'>Delete</a>
// 		</div>
// 		</div>".$this->buildMenu($menu, $item->id) . "</li>";
// 		}
// 		return $result ?  "\n<ol class=\"dd-list\">\n$result</ol>\n" : null;
	}

	// Getter for the HTML menu builder
	public function getHTML($items, $locale)
	{
		return $this->buildMenu($items, $locale);
	}


	public function getLinks($menu_id, $locale)
	{
		$query = $this->model
//		->with('translations')
		->join('menulink_translations', 'menulinks.id', '=', 'menulink_translations.menulink_id')
		->where('menulinks.menu_id', '=', $menu_id)
		->where('menulink_translations.status', '=', 1, 'AND')
		->where('menulink_translations.locale', '=', $locale)
		->orderBy('menulinks.position');
//dd($query);
//		$query->where('status', 1);
//dd($query);

		$models = $query->get();
//dd($models);

		return $models;
	}




}
