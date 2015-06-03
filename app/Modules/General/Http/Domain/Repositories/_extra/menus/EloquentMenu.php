<?php
namespace TypiCMS\Modules\Menus\Repositories;

use App;
use Categories;
use Config;
use ErrorException;
use Illuminate\Database\Eloquent\Model;
use Log;
use Request;
use TypiCMS\Modules\Menus\Models\Menu;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentMenu extends RepositoriesAbstract implements MenuInterface
{

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all models
     *
     * @param  array       $with Eager load related models
     * @param  boolean     $all  Show published or all
     * @return Collection|NestedCollection
     */
    public function all(array $with = array(), $all = false)
    {
        $query = $this->make($with);

        if (! $all) {
            $query->online();
        }

        // Query ORDER BY
        $query->order();

        // Get
        return $query->get();
    }

    /**
     * Render a menu
     *
     * @param  string $name menu name
     * @return string       html code of a menu
     */
    public function render($name)
    {
        return view('menus::public._menu', ['name' => $name]);
    }

    /**
     * Build a menu
     *
     * @deprecated
     * @param  string $name       menu name
     * @return string             html code of a menu
     */
    public function build($name)
    {
        return $this->render($name);
    }

    /**
     * Get a menu
     *
     * @param  string $name menu name
     * @return Model  $menu nested collection
     */
    public function getMenu($name)
    {
        try {
            $menu = app('TypiCMS.menus')->filter(function(Menu $menu) use ($name) {
                return $menu->name == $name;
            })->first();
        } catch (ErrorException $e) {
            Log::info('No menu found with name “' . $name . '”');
            return null;
        }

        $menu->menulinks = $this->prepare($menu->menulinks);

        $menu->menulinks->nest();

        return $menu;
    }

    public function prepare($items = null)
    {
        $items->each(function ($item) {
            if ($item->has_categories) {
                $item->items = $this->prepare(Categories::allForMenu($item->page->uri));
            }
            $item->href = $this->setHref($item);
            $item->class = $this->setClass($item);
        });

        return $items;
    }

    /**
     * 1. if menulink has url field, take it
     * 2. if menulink has a page, take the uri of the page
     *
     * @param Model   $menulink
     * @return string uri
     */
    public function setHref($menulink)
    {
        if ($menulink->url) {
            return $menulink->url;
        }

        if ($menulink->page) {
            $langPrefix = null;
            if (
                config('app.fallback_locale') != config('app.locale') ||
                config('typicms.main_locale_in_url')
            ) {
                $langPrefix = '/' . config('app.locale');
            }

            return $langPrefix . '/' . $menulink->page->uri;
        }

        return '';

    }

    /**
     * Take the classes from field and add active if needed
     *
     * @param Model   $menulink
     * @return string classes
     */
    public function setClass($menulink)
    {
        $activeUri = Request::getRequestUri();
        $classArray = preg_split('/ /', $menulink->class, null, PREG_SPLIT_NO_EMPTY);
        // add active class if item uri equals current uri
        // or current uri contain item uri
        // item uri must be bigger than 3 to avoid homepage link always active ('/', '/lg')
        if ($menulink->href == $activeUri ||
                (
                    strlen($menulink->href) > 3 &&
                    preg_match('@^'.$menulink->href.'@', $activeUri)
                )
            ) {
            $classArray[] = 'active';
        }
        return implode(' ', $classArray);
    }
}
