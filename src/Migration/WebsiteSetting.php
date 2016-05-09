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

use Pimcore\Model\WebsiteSetting as Setting;

/**
 * WebsiteSetting Class
 *
 * A helper class to simplify creating, updating and deleting website settings.
 *
 * @author Asim Liaquat <asim@byng.co>
 */
class WebsiteSetting
{
    const TYPE_BOOL = "bool";
    const TYPE_TEXT = "text";
    const TYPE_DOCUMENT = "document";
    const TYPE_ASSET = "asset";
    const TYPE_OBJECT = "object";

    /**
     * Create a website setting.
     *
     * @param string     $name
     * @param string     $type
     * @param int|string $data
     * @return Setting
     */
    public function create($name, $type, $data)
    {
        $setting = new Setting();
        $setting->setName($name);
        $setting->setType($type);
        $setting->setData($data);
        $setting->setCreationDate(time());
        $setting->setModificationDate(time());
        $setting->save();

        return $setting;
    }

    /**
     * Update a setting.
     *
     * @param string     $name
     * @param int|string $data
     * @return null|Setting
     */
    public function update($name, $data)
    {
        $setting = Setting::getByName($name);

        if ($setting) {
            $setting->setData($data);
            $setting->setCreationDate(time());
            $setting->setModificationDate(time());

            $setting->save();
        }

        return $setting;
    }

    /**
     * Delete a setting.
     *
     * @param string $name
     */
    public function delete($name)
    {
        $setting = Setting::getByName($name);

        if ($setting) {
            $setting->delete();
        }
    }
}
