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

use Pimcore\Model\Object\ClassDefinition;

/**
 * Object Definition
 *
 * Modify ClassDefinitions in Pimcore using JSON exports from Pimcore's admin interface.
 *
 * @author Elliot Wright <elliot@byng.co>
 * @author Callum Jones <callum@byng.co>
 */
class ObjectDefinition
{
    /**
     * Create an object given a class name and JSON export.
     *
     * @param string $className
     * @param string $filePath
     * @return ClassDefinition
     */
    public function create($className, $filePath)
    {
        $class = ClassDefinition::getByName($className);

        if (!$class) {
            $class = new ClassDefinition();
            $class->setName($className);
        }

        $objectDefinitionJson = file_get_contents($filePath);

        try {
            ClassDefinition\Service::importClassDefinitionFromJson($class, $objectDefinitionJson);
        } catch (\Exception $e) {
            echo "Exception caught: might not be an issue, check Pimcore." . PHP_EOL;
            echo $e->getMessage() . PHP_EOL;
        }

        return $class;
    }

    /**
     * Delete an object given a class name.
     *
     * @param string $className
     * @return void
     */
    public function delete($className)
    {
        $class = ClassDefinition::getByName($className);

        if ($class) {
            $class->delete();
        }
    }
}
