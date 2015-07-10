<?php

namespace Byng\Resolver;

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
