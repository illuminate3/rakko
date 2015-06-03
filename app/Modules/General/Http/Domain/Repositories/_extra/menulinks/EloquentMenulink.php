<?php
namespace TypiCMS\Modules\Menulinks\Repositories;

use DB;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Log;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentMenulink extends RepositoriesAbstract implements MenulinkInterface
{

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get a menu’s items and children
     *
     * @param  integer  $id
     * @param  boolean  $all published or all
     * @return Collection
     */
    public function allFromMenu($id = null, $all = false)
    {
        $query = $this->model->with('translations')
            ->order()
            ->where('menu_id', $menuId);

        // All posts or only published
        if (! $all) {
            $query->where('status', 1);
        }

        $models = $query->get()->nest();

        return $models;
    }

    /**
     * Get sort data
     *
     * @param  integer $position
     * @param  array   $item
     * @return array
     */
    protected function getSortData($position, $item)
    {
        return [
            'position' => $position,
            'parent_id' => $item['parent_id']
        ];
    }
}
