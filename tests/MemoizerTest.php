<?php

namespace Byng\Pimcore\Tests;

use Byng\Pimcore\Memoizer;

/**
 * Class Memoizer
 * @package Tests
 * @author Callum Jones <callum@byng.co>
 */
class MemoizerTest extends \PHPUnit_Framework_TestCase
{
    public function testMemoizeFoundInCache()
    {
        $cacheValue = "cache_value";

        $cacheStub = $this->getMockBuilder("Byng\\Pimcore\\Cache\\CacheInterface")->getMock();
        $cacheStub->method("fetch")
            ->willReturn($cacheValue);

        $memoizer = new Memoizer($cacheStub);

        $this->assertEquals(
            $memoizer->memoize("cache_key", function() {
                return "function_value";
            }),
            $cacheValue
        );
    }

    public function testMemoizeNotFoundInCache()
    {
        $mockCache = new MockCache();
        $memoizer = new Memoizer($mockCache);

        $key = "cache_key";

        $this->assertFalse(
            $mockCache->contains($key)
        );

        $this->assertEquals(
            $memoizer->memoize("cache_key", function() {
                return "function_value";
            }),
            "function_value"
        );

        $this->assertEquals(
            $mockCache->fetch($key),
            "function_value"
        );
    }
}
