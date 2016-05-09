<?php

namespace Byng\Pimcore\Migration;

use Pimcore\Model\Object\ClassDefinition;

/**
 * Class ObjectDefinition
 *
 * Modify ClassDefinitions in Pimcore using JSON exports from Pimcore's admin interface.
 *
 * @package Byng\Pimcore\Migration
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
    }

    /**
     * Delete an object given a class name.
     *
     * @param string $className
     */
    public function delete($className)
    {
        $class = ClassDefinition::getByName($className);

        if ($class) {
            $class->delete();
        }
    }
}
