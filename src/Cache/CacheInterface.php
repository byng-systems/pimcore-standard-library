<?php

namespace Byng\Pimcore\Cache;

/**
 * Interface CacheInterface
 *
 * @package Byng\Pimcore\Cache
 */
interface CacheInterface
{
    /**
     * Fetches an entry from the cache.
     *
     * @param $id
     *
     * @return mixed
     */
    public function fetch($id);

    /**
     * Tests if an entry exists in the cache.
     *
     * @param $id
     *
     * @return mixed
     */
    public function contains($id);

    /**
     * Puts data into the cache.
     *
     * @param $id
     * @param $data
     * @param int $lifeTime
     *
     * @return mixed
     */
    public function save($id, $data, $lifeTime = 0);

    /**
     * Deletes a cache entry.
     * 
     * @param $id
     * 
     * @return mixed
     */
    public function delete($id);
}
