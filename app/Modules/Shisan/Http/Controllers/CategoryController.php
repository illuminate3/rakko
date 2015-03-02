<?php
namespace App\Modules\Shisan\Http\Controllers;


/**
 * This controller is used to display categories.
 */
class CategoryController extends ShisanController {

	protected $layout = 'layouts.master';

	/**
	 * The category storage.
	 *
	 * @var  Category
	 */
	protected $category;

	public function __construct(Category $category)
	{
		$this->category = $category;
	}

	/**
	 * Display a category with given slug.
	 *
	 * @param   string  $slug
	 *
	 * @return  mixed
	 */
	public function show($slug = '/')
	{
//		$category = $this->category->whereSlug($slug)->first();
		$category = $this->category->with('items')->whereSlug($slug)->first();
//dd($category);

		if ($category === null)
		{
			App::abort(404, 'Sorry, but requested category doesn\'t exists.');
		}

        $view = $category->isRoot() ? 'home.categories_index' : 'home.category';

        $this->layout->title = $category->title;
        $this->layout->content = View::make($view, compact('category'));
        $this->layout->menu = $this->getMenu($category);
$this->layout->mainMenu = $this->getMenu2($category);
        $this->layout->breadcrumbs = $this->getBreadcrumbs($category);
	}

	/**
	 * Get breadcrumbs to the current category.
	 *
	 * $active is the last crumb (the category title by default).
	 *
	 * @param   Category    $category
	 * @param   string  $active
	 * @param 	string  $route
	 *
	 * @return  array
	 */
	protected function getBreadcrumbs(Category $category, $active = null, $route = 'category')
	{
		if ($category->isRoot()) return array();

		$breadcrumbs['Index'] = url('/');
		$ancestors = $category
			->ancestors()
			->withoutRoot()
			->get(array('id', 'title', 'slug'));

		if ($active !== null) $ancestors->push($category);

		foreach ($ancestors as $item)
		{
			$breadcrumbs[$item->title] = route($route, array($item->slug));
		}

		$breadcrumbs[] = $active !== null ? $active : $category->title;

		return $breadcrumbs;
	}

    /**
     * Get main menu items.
     *
     * @param Category $activeCategory
     *
     * @return array
     */
	protected function getMenu(Category $activeCategory)
	{
		$itemTree = $this->category
			->where('parent_id', '=', 1)
			->get([ 'id', 'slug', 'title', '_lft', 'parent_id' ])
			->toTree();

		return make_nav($itemTree, $activeCategory->getKey());
	}
	protected function getMenu2(Category $activeCategory)
	{

		$itemTree = $this->category
//		$itemTree = DB::table('categories')
			->where('parent_id', '!=', 'NULL')
			->get([ 'id', 'slug', 'title', '_lft', 'parent_id' ])
			->toTree();

		return make_nav($itemTree, $activeCategory->getKey());
	}

}
