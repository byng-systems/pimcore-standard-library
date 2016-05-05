<?php

namespace Byng\Pimcore\Controller\Traits;

use Pimcore\Model\Cache;
use Pimcore\Tool\Frontend as ToolFrontend;
use Pimcore\Model\Document;
use Byng\Pimcore\Delegate\Logger;

/**
 * LanaguageErrorPageTrait
 *
 * @author Asim Liaquat <asim@byng.co>
 */
trait LanaguageErrorPageTrait
{
    
    /**
     * @var Logger
     */
    private static $logger;
    
    /**
     * Set a logger if logging is required
     * 
     * @param Logger $logger
     */
    public function setLanaguageErrorPageLogger(Logger $logger)
    {
        self::$logger = $logger;
    }
    
    /**
     * Overrides the parent checkForErrors method which caches the error page
     * hence the controller/action never get called so can't perform any
     * additional logging.
     * 
     * {@inheritdoc}
     */
    public function checkForErrors()
    {
        // Check if there is an error before executing the error handling logic
        // because this method gets called on every request.
        if (($error = $this->getParam('error_handler')) && $error->exception) {
            
            // Remove the existing cache entry because we will display the
            // error page in different languages and pimcore uses a single key
            // when caching the error page which means the same error page will
            // be displayed in subsequent requests even if the user changes the
            // language
            Cache::remove("error_page_response_" . ToolFrontend::getSiteKey());

            // Log the error if a logger has been set
            if (self::$logger) {
                self::$logger->log(
                    $error->exception,
                    \Zend_Log::CRIT
                );
            }
            
            // The language property is not set at this point because this
            // happens really early on in the request so we have fetch it from
            // the url manually
            $path = $this->getRequest()->getRequestUri();
            preg_match("@^/([^/]+)/@", $path, $matches);
            
            if ($matches) {
                
                // fetch the correct error document based on the language
                $document = Document::getByPath(sprintf(
                    "/%s/error",
                    $matches[1]
                ));

                // Check if we have a valid document in case someone manipulates
                // the url manually. If there is no matching error document
                // then it will fall back to the default 'en' error page
                if ($document) {
                    \Zend_Registry::set("pimcore_error_document", $document);
                }
            }
        }
    
        // Calls Pimcore\Controller\Action\Frontend::checkForErrors()
        parent::checkForErrors();
    }
    
}
