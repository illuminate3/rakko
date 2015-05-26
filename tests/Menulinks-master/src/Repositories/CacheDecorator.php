<?php
namespace TypiCMS\Modules\Menulinks\Repositories;

use Illuminate\Database\Eloquent\Collection;
use TypiCMS\Modules\Core\Repositories\CacheAbstractDecorator;
use TypiCMS\Modules\Core\Services\Cache\CacheInterface;

class CacheDecorator extends CacheAbstractDecorator implements MenulinkInterface
{

    public function __construct(MenulinkInterface $repo, CacheInterface $cache)
    {
        $this->repo = $repo;
        $this->cache = $cache;
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
        $cacheKey = md5(config('app.locale').'all'.$all.$id);

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        $models = $this->repo->allFromMenu($id, $all);

        // Store in cache for next request
        $this->cache->put($cacheKey, $models);

        return $models;
    }
}
