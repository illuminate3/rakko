<?php
namespace TypiCMS\Modules\Core\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use stdClass;
use TypiCMS\Modules\Pages\Models\Page;
use TypiCMS\NestedCollection;

abstract class RepositoriesAbstract implements RepositoryInterface
{
    protected $model;

    /**
     * Get empty model
     *
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Get table name
     *
     * @return string
     */
    public function getTable()
    {
        return $this->model->getTable();
    }

    /**
     * Make a new instance of the entity to query on
     *
     * @param array $with
     */
    public function make(array $with = array())
    {
        if (method_exists($this->model, 'translations')) {
            if (! in_array('translations', $with)) {
                $with[] = 'translations';
            }
        }
        return $this->model->with($with);
    }

    /**
     * Find a single entity by key value
     *
     * @param string $key
     * @param string $value
     * @param array  $with
     */
    public function getFirstBy($key, $value, array $with = array(), $all = false)
    {
        $query = $this->make($with);
        if (! $all) {
            $query->online();
        }
        return $query->where($key, '=', $value)->first();
    }

    /**
     * Retrieve model by id
     * regardless of status
     *
     * @param  int       $id model ID
     * @return Model
     */
    public function byId($id, array $with = array())
    {
        $query = $this->make($with)->where('id', $id);

        $model = $query->firstOrFail();

        return $model;
    }

    /**
     * Get next model
     *
     * @param  Model      $model
     * @param  array      $with
     * @param  boolean    $all
     * @return Collection
     */
    public function next($model, array $with = [], $all = false)
    {
        return $this->adjacent(1, $model, $with, $all);
    }

    /**
     * Get prev model
     *
     * @param  Model      $model
     * @param  array      $with
     * @param  boolean    $all
     * @return Collection
     */
    public function prev($model, array $with = [], $all = false)
    {
        return $this->adjacent(-1, $model, $with, $all);
    }

    /**
     * Get prev model
     *
     * @param  Model      $model
     * @param  array      $with
     * @return Collection
     */
    private function adjacent($direction, $model, array $with = [], $all = false)
    {
        $currentModel = $model;
        $models = $this->all($with, $all);
        foreach ($models as $key => $model) {
            if ($currentModel->id == $model->id) {
                $adjacentKey = $key + $direction;
                return isset($models[$adjacentKey]) ? $models[$adjacentKey] : null ;
            }
        }
        return null;
    }

    /**
     * Get paginated models
     *
     * @param  int      $page  Number of models per page
     * @param  int      $limit Results per page
     * @param  boolean  $all   get published models or all
     * @param  array    $with  Eager load related models
     * @return stdClass Object with $items && $totalItems for pagination
     */
    public function byPage($page = 1, $limit = 10, array $with = array(), $all = false)
    {
        $result = new stdClass;
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        $query = $this->make($with);

        if (! $all) {
            $query->online();
        }

        $totalItems = $query->count();

        $query->order()
            ->skip($limit * ($page - 1))
            ->take($limit);

        $models = $query->get();

        // Put items and totalItems in stdClass
        $result->totalItems = $totalItems;
        $result->items = $models->all();

        return $result;
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
     * Get all models and nest
     *
     * @param  boolean                    $all  Show published or all
     * @param  array                      $with Eager load related models
     * @return NestedCollection
     */
    public function allNested(array $with = array(), $all = false)
    {
        // Get
        return $this->all($with, $all)->nest();
    }

    /**
     * Get all models by key/value
     *
     * @param  string     $key
     * @param  string     $value
     * @param  array      $with
     * @param  boolean    $all
     * @return Collection
     */
    public function allBy($key, $value, array $with = array(), $all = false)
    {
        $query = $this->make($with);

        if (! $all) {
            $query->online();
        }

        $query->where($key, $value);

        // Query ORDER BY
        $query->order();

        // Get
        $models = $query->get();

        return $models;
    }

    /**
     * Get all models by key/value and nest collection
     *
     * @param  string     $key
     * @param  string     $value
     * @param  array      $with
     * @param  boolean    $all
     * @return Collection
     */
    public function allNestedBy($key, $value, array $with = array(), $all = false)
    {
        // Get
        return $this->allBy($key, $value, $with, $all)->nest();
    }

    /**
     * Get latest models
     *
     * @param  integer      $number number of items to take
     * @param  array        $with array of related items
     * @return Collection
     */
    public function latest($number = 10, array $with = array())
    {
        $query = $this->make($with);
        return $query->online()->order()->take($number)->get();
    }

    /**
     * Get single model by Slug
     *
     * @param  string $slug slug
     * @param  array  $with related tables
     * @return mixed
     */
    public function bySlug($slug, array $with = array())
    {
        $model = $this->make($with)
            ->whereHas(
                'translations',
                function (Builder $query) use ($slug) {
                    if (! Input::get('preview')) {
                        $query->where('status', 1);
                    }
                    $query->where('locale', config('app.locale'));
                    $query->where('slug', '=', $slug);
                }
            )
            ->firstOrFail();

        if (! count($model->translations)) {
            abort(404);
        }

        return $model;

    }

    /**
     * Return all results that have a required relationship
     *
     * @param string $relation
     * @param array  $with
     * @return Collection
     */
    public function has($relation, array $with = array())
    {
        $entity = $this->make($with);

        return $entity->has($relation)->get();
    }

    /**
     * Create a new model
     *
     * @param  array $data
     * @return mixed Model or false on error during save
     */
    public function create(array $data)
    {
        // Create the model
        $model = $this->model->fill($data);

        if ($model->save()) {
            $this->syncRelation($model, $data, 'galleries');
            return $model;
        }

        return false;
    }

    /**
     * Update an existing model
     *
     * @param  array  $data
     * @return boolean
     */
    public function update(array $data)
    {
        $model = $this->model->find($data['id']);

        $model->fill($data);

        $this->syncRelation($model, $data, 'galleries');

        if ($model->save()) {
            return true;
        }

        return false;

    }

    /**
     * Sort models
     *
     * @param  array $data updated data
     * @return void
     */
    public function sort(array $data)
    {
        foreach ($data['item'] as $position => $item) {

            $page = $this->model->find($item['id']);

            $sortData = $this->getSortData($position + 1, $item);

            $page->update($sortData);

            if ($data['moved'] == $item['id']) {
                $this->fireResetChildrenUriEvent($page);
            }

        }

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
            'position' => $position
        ];
    }

    /**
     * Fire event to reset children’s uri
     * Only applicable on nestable collections
     *
     * @param  Page    $page
     * @return void|null
     */
    protected function fireResetChildrenUriEvent($page)
    {
        return null;
    }

    /**
     * Build a select menu for a module
     *
     * @param  string  $method     with method to call from the repository ?
     * @param  boolean $firstEmpty generate an empty item
     * @param  string  $value      witch column as value ?
     * @param  string  $key        witch column as key ?
     * @return array               array with key = $key and value = $value
     */
    public function select($method = 'all', $firstEmpty = false, $value = 'title', $key = 'id')
    {
        $items = $this->$method()->lists($value, $key);
        if ($firstEmpty) {
            $items = ['' => ''] + $items;
        }
        return $items;
    }

    /**
     * Get all translated pages for a select/options
     *
     * @return array
     */
    public function getPagesForSelect()
    {
        $pages = app('TypiCMS\Modules\Pages\Repositories\PageInterface')
            ->all([], true)
            ->nest()
            ->listsFlattened();
        $pages = ['' => ' '] + $pages;
        return $pages;
    }

    /**
     * Delete model
     *
     * @return boolean
     */
    public function delete($model)
    {
        if ($model->delete()) {
            return true;
        }

        return false;
    }

    /**
     * Sync related items for model
     *
     * @param  Model $model
     * @param  array                               $data
     * @param  string                              $table
     * @return false|null
     */
    protected function syncRelation($model, array $data, $table = null)
    {
        if (! method_exists($model, $table)) {
            return false;
        }

        // add related items
        $pivotData = array();
        $position = 0;
        if (isset($data[$table])) {
            foreach ($data[$table] as $id) {
                $pivotData[$id] = ['position' => $position++];
            }
        }

        // Sync related items
        $model->$table()->sync($pivotData);
    }
}
