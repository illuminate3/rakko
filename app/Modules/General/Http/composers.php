<?php
namespace App\Modules\Shisan\Lib;

use App\Modules\Shisan\Http\Domain\Models\Category;
//use App\Modules\Shisan\Lib\helpers;

use View;

View::composer('layouts.master', function ($view)
{
	if (!isset($view->title)) $view->title = 'Nested Set App';
});

View::composer(['layouts.content', 'layouts.backend'], function ($view)
{
	if (!isset($view->content)) $view->content = '';
});

View::composer('home.page', function ($view)
{
	$page = $view->page;

	$view->contents = make_nav_tree($page->getContents(), $page->getKey());
	$view->next = $page->getNext();
	$view->prev = $page->getPrev();
});


View::composer(['_partials.left_side'], function ($view)
//View::composer(['layouts._partials.left_side'], function ($view)
{
$category = Category::with('items')->whereSlug('/')->first();
if ( $category != null ) {
	$itemTree = Category::where('parent_id', '!=', 'NULL')
		->get([ 'id', 'slug', 'title', '_lft', 'parent_id' ])
		->toTree();
	$view->menu2 = make_nav_tree($itemTree, $category->getKey());
}
//dd($menu2);
});
