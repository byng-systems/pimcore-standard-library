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

namespace Byng\Pimcore\Controller;

use Pimcore\Controller\Action\Frontend;

/**
 * Abstract Action
 *
 * @author Asim Liaquat <asim@byng.co>
 */
abstract class AbstractAction extends Frontend
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if (\Zend_Registry::isRegistered("Zend_Locale")) {
            $locale = \Zend_Registry::get("Zend_Locale");
        } else {
            $locale = new \Zend_Locale("en");
            \Zend_Registry::set("Zend_Locale", $locale);
        }

        $this->view->language = (string) $locale;
        $this->language = (string) $locale;
    }
}
