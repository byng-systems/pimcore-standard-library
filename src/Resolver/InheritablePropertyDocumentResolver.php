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

namespace Byng\Resolver;

use Pimcore\Model\Document;
use Pimcore\Model\Property;

/**
 * Inheritable Property Document Resolver
 *
 * Retrieves the document in which a document property is defined. It traverses up the tree
 * recursively.
 *
 * @author Asim Liaquat <asim@byng.co>
 */
class InheritablePropertyDocumentResolver
{
    /**
     * Attempt to find an inheritable property by a given name on the current document.
     *
     * @param Document $document
     * @param string   $propertyName
     * @return mixed
     */
    public function find(Document $document, $propertyName)
    {
        if (!$document) {
            return null;
        }

        /** @var Property $property */
        $property = $document->getProperty($propertyName, true);

        if (!$property) {
            return null;
        }

        if (!$property->getInherited()) {
            return $document;
        }

        // See if parent document has the property.
        return $this->find($document->getParent(), $propertyName);
    }
}
