<?php

/**
 * This file is part of the pimcore-standard-library package.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the LICENSE is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Byng\Pimcore\Migration;

use Pimcore\Model\Object\ClassDefinition\Service as ClassDefinitionService;
use Pimcore\Model\Object\Fieldcollection\Definition as PimcoreDefinition;

/**
 * Field Collection Definition
 *
 * Ease the process of adding and removing field collections. Uses JSON exports from Pimcore's admin
 * interface.
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class FieldCollectionDefinition
{
    /**
     * Create a field collection given a collection name, and JSON export.
     *
     * @param string $collectionName
     * @param string $filePath
     * @return PimcoreDefinition
     */
    public function create($collectionName, $filePath)
    {
        try {
            $fieldCollection = PimcoreDefinition::getByKey($collectionName);
        } catch (\Exception $e) {
            $fieldCollection = new PimcoreDefinition();
            $fieldCollection->setKey($collectionName);
        }

        $json = file_get_contents($filePath);

        try {
            ClassDefinitionService::importFieldCollectionFromJson($fieldCollection, $json);
        } catch (\Zend_Db_Statement_Exception $e) {
            // Sometimes this just seems to error for no reason, but still works fine
            echo "Exception caught: Might not be an issue, check Pimcore." . PHP_EOL;
            echo $e->getMessage() . PHP_EOL;
        }

        return $fieldCollection;
    }

    /**
     * Delete a field collection with a given name.
     *
     * @param string $collectionName
     * @return void
     */
    public function delete($collectionName)
    {
        $fieldCollection = PimcoreDefinition::getByKey($collectionName);

        if ($fieldCollection) {
            $fieldCollection->delete();
        }
    }
}
