<?php

namespace Byng\Resolver;

/**
 * InheritablePropertyDocumentResolver
 *
 * Retrieves the document in which a document property is defined. It traverses up
 * the tree recursively.
 *
 * @package    Byng
 * @subpackage Resolver
 * @author     Asim Liaquat <asim@byng.co>
 */
class InheritablePropertyDocumentResolver
{
    /**
     *
     * @var \Document_Page
     */
    private $currentDocument;
    
    /**
     * 
     * @param \Document_Page $currentDocument
     */
    public function __construct(\Document_Page $currentDocument)
    {
        $this->currentDocument = $currentDocument;
    }
    
    /**
     * 
     * @param string $propertyName
     * 
     * @return \Document_Page|null
     */
    public function getPropertyDocument($propertyName)
    {
        /* @var $property \Property */
        $property = $this->currentDocument->getProperty($propertyName, true);
                
        if(!$property) {
            return null;
        }
        
        if(!$property->getInherited()) {
            return $this->currentDocument;
        }
        
        $document = $this->currentDocument;
        while(($document = $document->getParent())) {
            /* @var $property \Property */
            $property = $document->getProperty($propertyName, true);
            if(!$property->getInherited()) {
                return $document;
            }
        }
        
        return null;
    }
    
}
