<?php

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

	$view->contents = make_nav($page->getContents(), $page->getKey());
	$view->next = $page->getNext();
	$view->prev = $page->getPrev();
});


View::composer(['layouts._partials.left_side', 'layouts.content'], function ($view)
//View::composer(['layouts._partials.left_side'], function ($view)
{
$category = Category::with('items')->whereSlug('/')->first();
$itemTree = Category::where('parent_id', '!=', 'NULL')
	->get([ 'id', 'slug', 'title', '_lft', 'parent_id' ])
	->toTree();
$view->menu2 = make_nav($itemTree, $category->getKey());
//dd($menu2);
});
