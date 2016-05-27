<?php

namespace Byng\Pimcore\Cache;

use Pimcore\Model\Cache;

/**
 * Class PimcoreCache
 * 
 * @package Byng\Pimcore\Cache
 */
class PimcoreCache implements CacheInterface {
    
    /**
     * Fetches an entry from the cache.
     *
     * @param $id
     *
     * @return mixed
     */
    public function fetch($id)
    {
        return Cache::load($id);
    }

    /**
     * Tests if an entry exists in the cache.
     *
     * @param $id
     *
     * @return mixed
     */
    public function contains($id)
    {
        return (bool) $this->fetch($id);
    }

    /**
     * Puts data into the cache.
     *
     * @param $id
     * @param $data
     * @param int $lifeTime
     *
     * @return mixed
     */
    public function save($id, $data, $lifeTime = 0)
    {
        return Cache::save($data, $id, [], $lifeTime);
    }

    /**
     * Deletes a cache entry.
     *
     * @param $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        return Cache::delete($id);
    }
}