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

namespace Byng\Pimcore\Migration;

use Pimcore\Model\Translation\Website as SiteTranslation;
use Pimcore\Tool;

/**
 * Website Translation Wrapper
 *
 * A helper class to simplify managing shared translations programatically.
 *
 * @author Asim Liaquat <asim@byng.co>
 */
class WebsiteTranslation
{
    /**
     * Add new translations
     *
     * The method accepts an array of translations where the key is the
     * translation key and the value is an array where each row is a translation
     * for a specific language. e.g.
     *
     *  $translations = [
     *      "btn_continue" => [
     *          "en" => "Continue"
     *      ],
     *   ];
     *
     * @param array $translations
     * @return void
     */
    public function create(array $translations = [ ])
    {
        SiteTranslation::clearDependentCache();

        foreach ($translations as $key => $translations) {
            try {
                $t = SiteTranslation::getByKey($key);
            } catch (\Exception $e) {
                $t = new SiteTranslation();
                $t->setKey($key);
                $t->setCreationDate(time());
                $t->setModificationDate(time());

                foreach (Tool::getValidLanguages() as $lang) {
                    if (isset($translations[$lang])) {
                        $t->addTranslation($lang, $translations[$lang]);
                    } else {
                        $t->addTranslation($lang, "");
                    }
                }

                $t->save();
            }
        }
    }

    /**
     * Update translations
     *
     * @param array $translations Same as the create method
     * @return void
     */
    public function update(array $translations = [ ])
    {
        SiteTranslation::clearDependentCache();

        foreach ($translations as $key => $translations) {
            try {
                $t = SiteTranslation::getByKey($key);
                $t->setModificationDate(time());

                foreach (Tool::getValidLanguages() as $lang) {
                    if (isset($translations[$lang])) {
                        $t->addTranslation($lang, $translations[$lang]);
                    } else {
                        $t->addTranslation($lang, "");
                    }
                }

                $t->save();
            } catch (\Exception $e) {
                // @todo: LOG
            }
        }
    }

    /**
     * Delete a translation
     *
     * @param string $key
     * @return void
     */
    public function delete($key)
    {
        $translation = SiteTranslation::getByKey($key);

        if ($translation) {
            $translation->delete();
        }
    }
}
