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

namespace Byng\Pimcore\Delegate;

use Logger as PimcoreLogger;

/**
 * Logger provides the same interface Pimcores Logger class and delegates all
 * method calls to Pimcores logger.
 *
 * @todo: This whole interface is a bit unnecessarily large. We can trim down the duplicate methods,
 *        I know this is a pass-through object effectively, but we can also control the API a little
 *        more with this delegate approach too. We should take advantage of that, before we have to
 *        maintain more code.
 * @todo: Property parameter annotations. Needs testing to find what type of class can be added.
 *
 * @author Asim Liaquat <asim@byng.co>
 */
class Logger
{
    /**
     * @see PimcoreLogger::setLogger()
     */
    public function setLogger($logger)
    {
        PimcoreLogger::setLogger($logger);
    }

    /**
     * @see PimcoreLogger::resetLoggers()
     */
    public function resetLoggers()
    {
        PimcoreLogger::resetLoggers();
    }

    /**
     * @see PimcoreLogger::getLogger()
     */
    public function getLogger()
    {
        PimcoreLogger::getLogger();
    }

    /**
     * @see PimcoreLogger::addLogger()
     */
    public function addLogger($logger, $reset = false)
    {
        PimcoreLogger::addLogger($logger, $reset);
    }

    /**
     * @see PimcoreLogger::setPriorities()
     */
    public function setPriorities($prios)
    {
        PimcoreLogger::setPriorities($prios);
    }

    /**
     * @see PimcoreLogger::getPriorities()
     */
    public function getPriorities()
    {
        PimcoreLogger::getPriorities();
    }

    /**
     * @see PimcoreLogger::initDummy()
     */
    public function initDummy()
    {
        PimcoreLogger::initDummy();
    }

    /**
     * @see PimcoreLogger::disable()
     */
    public function disable()
    {
        PimcoreLogger::disable();
    }

    /**
     * @see PimcoreLogger::enable()
     */
    public function enable()
    {
        PimcoreLogger::enable();
    }

    /**
     * @see PimcoreLogger::setVerbosePriorities()
     */
    public function setVerbosePriorities()
    {
        PimcoreLogger::setVerbosePriorities();
    }

    /**
     * @see PimcoreLogger::log()
     */
    public function log($message, $code = Zend_Log::INFO)
    {
        PimcoreLogger::log($message, $code);
    }

    /**
     * @see PimcoreLogger::emergency()
     */
    public function emergency($m, $l = null)
    {
        PimcoreLogger::emergency($m, $l);
    }

    /**
     * @see PimcoreLogger::emerg()
     */
    public function emerg($m, $l = null)
    {
        PimcoreLogger::emerg($m, $l);
    }

    /**
     * @see PimcoreLogger::critical()
     */
    public function critical($m, $l = null)
    {
        PimcoreLogger::critical($m, $l);
    }

    /**
     * @see PimcoreLogger::crit()
     */
    public function crit($m, $l = null)
    {
        PimcoreLogger::crit($m, $l);
    }

    /**
     * @see PimcoreLogger::error()
     */
    public function error($m, $l = null)
    {
        PimcoreLogger::error($m, $l);
    }

    /**
     * @see PimcoreLogger::err()
     */
    public function err($m, $l = null)
    {
        PimcoreLogger::err($m, $l);
    }

    /**
     * @see PimcoreLogger::alert()
     */
    public function alert($m, $l = null)
    {
        PimcoreLogger::alert($m, $l);
    }

    /**
     * @see PimcoreLogger::warning()
     */
    public function warning($m, $l = null)
    {
        PimcoreLogger::warning($m, $l);
    }

    /**
     * @see PimcoreLogger::warn()
     */
    public function warn($m, $l = null)
    {
        PimcoreLogger::warn($m, $l);
    }

    /**
     * @see PimcoreLogger::notice()
     */
    public function notice($m, $l = null)
    {
        PimcoreLogger::notice($m, $l);
    }

    /**
     * @see PimcoreLogger::info()
     */
    public function info($m, $l = null)
    {
        PimcoreLogger::info($m, $l);
    }

    /**
     * @see PimcoreLogger::debug()
     */
    public function debug($m, $l = null)
    {
        PimcoreLogger::debug($m, $l);
    }
}
