<?php
namespace TypiCMS\Modules\Core\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Input;
use TypiCMS\Modules\Core\Repositories\RepositoryInterface;
use TypiCMS\NestedCollection;

abstract class CacheAbstractDecorator implements RepositoryInterface
{
    protected $repo;
    protected $cache;

    /**
     * Get empty model
     *
     * @return Model
     */
    public function getModel()
    {
        return $this->repo->getModel();
    }

    /**
     * Get table name
     *
     * @return string
     */
    public function getTable()
    {
        return $this->repo->getTable();
    }

    /**
     * Make a new instance of the entity to query on
     *
     * @param array $with
     */
    public function make(array $with = array())
    {
        return $this->repo->make($with);
    }

    /**
     * Retrieve model by id
     * regardless of status
     *
     * @param  int       $id model ID
     * @return stdObject object of model information
     */
    public function byId($id, array $with = array())
    {
        // Build the cache key, unique per model slug
        $cacheKey = md5(config('app.locale') . 'id.' . implode('.', $with) . $id . implode('.', Input::all()));

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        // Item not cached, retrieve it
        $model = $this->repo->byId($id, $with);

        $this->cache->put($cacheKey, $model);

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
        // Build the cache key, unique per model slug
        $cacheKey = md5(config('app.locale') . 'next.' . $model->id . $all . implode('.', $with));
        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }
        // Item not cached, retrieve it
        $next = $this->repo->next($model, $with);

        $this->cache->put($cacheKey, $next);

        return $next;
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
        // Build the cache key, unique per model slug
        $cacheKey = md5(config('app.locale') . 'prev.' . $model->id . $all . implode('.', $with));
        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }
        // Item not cached, retrieve it
        $prev = $this->repo->prev($model, $with);

        $this->cache->put($cacheKey, $prev);

        return $prev;
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
        // Build the cache key, unique per model slug
        $cacheKey = md5(config('app.locale').'getFirstBy'.$key.$value.implode('.', $with).$all.implode('.', Input::all()));

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        // Item not cached, retrieve it
        $model = $this->repo->getFirstBy($key, $value, $with, $all);

        $this->cache->put($cacheKey, $model);

        return $model;
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
        $cacheKey = md5(config('app.locale').'byPage'.$page.$limit.implode('.', $with).$all.implode('.', Input::except('page')));

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        $models = $this->repo->byPage($page, $limit, $with, $all);

        // Store in cache for next request
        $this->cache->put($cacheKey, $models);

        return $models;
    }

    /**
     * Get all models
     *
     * @param  boolean  $all  Show published or all
     * @param  array    $with Eager load related models
     * @return Collection
     */
    public function all(array $with = array(), $all = false)
    {
        $cacheKey = md5(config('app.locale') . 'all' . implode('.', $with) . $all . implode('.', Input::except('page')));

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        // Item not cached, retrieve it
        $models = $this->repo->all($with, $all);

        // Store in cache for next request
        $this->cache->put($cacheKey, $models);

        return $models;
    }

    /**
     * Get all models and nest
     *
     * @param  boolean          $all  Show published or all
     * @param  array            $with Eager load related models
     * @return NestedCollection
     */
    public function allNested(array $with = array(), $all = false)
    {
        $cacheKey = md5(config('app.locale') . 'allNested' . implode('.', $with) . $all . implode('.', Input::except('page')));

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        // Item not cached, retrieve it
        $models = $this->repo->allNested($with, $all);

        // Store in cache for next request
        $this->cache->put($cacheKey, $models);

        return $models;
    }

    /**
     * Get all models by key/value
     *
     * @param  string     $key
     * @param  string     $value
     * @param  array      $with
     * @param  boolean    $all
     * @return stdClass Object with $items
     */
    public function allBy($key, $value, array $with = array(), $all = false)
    {
        $cacheKey = md5(config('app.locale').'allBy'.$key.$value.implode('.', $with).$all.implode('.', Input::all()));

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        // Item not cached, retrieve it
        $models = $this->repo->allBy($key, $value, $with, $all);

        // Store in cache for next request
        $this->cache->put($cacheKey, $models);

        return $models;
    }

    /**
     * Get all models by key/value and nest collection
     *
     * @param  string     $key
     * @param  string     $value
     * @param  array      $with
     * @param  boolean    $all
     * @return stdClass Object with $items
     */
    public function allNestedBy($key, $value, array $with = array(), $all = false)
    {
        $cacheKey = md5(config('app.locale').'allNestedBy'.$key.$value.implode('.', $with).$all.implode('.', Input::all()));

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        // Item not cached, retrieve it
        $models = $this->repo->allNestedBy($key, $value, $with, $all);

        // Store in cache for next request
        $this->cache->put($cacheKey, $models);

        return $models;
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
        $cacheKey = md5(config('app.locale') . 'latest' . $number . implode('.', $with) . implode('.', Input::all()));

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        // Item not cached, retrieve it
        $models = $this->repo->latest($number, $with);

        // Store in cache for next request
        $this->cache->put($cacheKey, $models);

        return $models;
    }

    /**
     * Get single model by slug
     *
     * @param  string $slug of model
     * @param  array  $with
     * @return object object of model information
     */
    public function bySlug($slug, array $with = array())
    {
        // Build the cache key, unique per model slug
        $cacheKey = md5(config('app.locale') . 'bySlug' . $slug . implode('.', $with) . implode('.', Input::all()));

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        // Item not cached, retrieve it
        $model = $this->repo->bySlug($slug, $with);

        // Store in cache for next request
        $this->cache->put($cacheKey, $model);

        return $model;

    }

    /**
     * Return all results that have a required relationship
     *
     * @param string $relation
     * @param array  $with
     */
    public function has($relation, array $with = array())
    {
        // Build the cache key, unique per model slug
        $cacheKey = md5(config('app.locale') . 'has' . implode('.', $with) . $relation);

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        // Item not cached, retrieve it
        $model = $this->repo->has($relation, $with);

        // Store in cache for next request
        $this->cache->put($cacheKey, $model);

        return $model;

    }

    /**
     * Create a new model
     *
     * @param array  Data needed for model creation
     * @return mixed Model or false on error during save
     */
    public function create(array $data)
    {
        $this->cache->flush();
        $this->cache->flush('dashboard');
        return $this->repo->create($data);
    }

    /**
     * Update an existing model
     *
     * @param array  Data needed for model update
     * @return boolean
     */
    public function update(array $data)
    {
        $this->cache->flush();
        return $this->repo->update($data);
    }

    /**
     * Sort models
     *
     * @param array  Data to update Pages
     * @return boolean|null
     */
    public function sort(array $data)
    {
        $this->cache->flush();
        $this->repo->sort($data);
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
        return $this->repo->select($method, $firstEmpty, $value, $key);
    }

    /**
     * Get all translated pages for a select/options
     *
     * @return array
     */
    public function getPagesForSelect()
    {
        return $this->repo->getPagesForSelect();
    }

    /**
     * Delete model
     *
     * @return boolean
     */
    public function delete($model)
    {
        $this->cache->flush();
        $this->cache->flush('dashboard');
        return $this->repo->delete($model);
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
        return $this->repo->syncRelation($model, $data, $table);
    }
}
