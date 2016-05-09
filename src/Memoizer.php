<?php

/**
 * This file is part of the pimcore-standard-library package.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Byng\Pimcore;

use Pimcore\Model\Cache;

/**
 * Memoizer
 *
 * Allows functions to be wrapped so that complex, or time-consuming tasks can be made much quicker
 * upon subsequent requests. This uses the built-in Pimcore Cache.
 *
 * @author Asim Liaquat <asim@byng.co>
 * @author Elliot Wright <elliot@elliotwright.co>
 */
final class Memoizer
{
    const LIFETIME_SHORT = 5;      // 5 seconds
    const LIFETIME_STANDARD = 60;  // 1 minute
    const LIFETIME_LONG = 60 * 60; // 1 hour

    /**
     * Wrap given code to provide a clean interface for caching.
     *
     * @param string   $key        A cache key
     * @param \Closure $fn         A function to cache the result of, is not run if data is cached
     * @param null|int $expiration Time before cache expires in seconds
     * @return mixed
     */
    public function memoize($key, \Closure $fn, $expiration = null)
    {
        $key = $this->transformCacheKey($key);
        if ($cachedData = Cache::load($key)) {
            $data = $cachedData;
        } else {
            $data = $fn();

            Cache::save($data, $key, [], $expiration);
        }

        return $data;
    }

    /**
     * Transforms a cache key so that is will work with Pimcore's Cache
     *
     * @param string $key
     * @return string
     */
    private function transformCacheKey($key)
    {
        return preg_replace("/[^a-zA-Z0-9]+/", "_", $key);
    }
}
