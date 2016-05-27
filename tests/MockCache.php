<?php

namespace Byng\Pimcore\Tests;

use Byng\Pimcore\Cache\CacheInterface;

/**
 * Class MockCache
 * @package MockCache
 * @author Callum Jones <callum@byng.co>
 */
class MockCache implements CacheInterface
{
    /**
     * @var array
     */
    private $cache = [];

    /**
     * Fetches an entry from the cache.
     *
     * @param $id
     *
     * @return mixed
     */
    public function fetch($id)
    {
        return isset($this->cache[$id]) ? $this->cache[$id] : false;
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
        return isset($this->cache[$id]);
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
        $this->cache[$id] = $data;

        return true;
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
        unset($this->cache[$id]);

        return true;
    }
}
