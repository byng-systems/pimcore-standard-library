<?php

namespace Byng\Pimcore\View\Helper;

use Logger;
use Byng\Memoizer;
use Zend_View_Helper_Abstract as AbstractViewHelper;

/**
 * Asset View Helper
 *
 * Abstracts the functionality required for linking to static assets. Will force URL updates for
 * cached resources to allow cache busting on CDNs (and may eventually support automatically using
 * CDNs based on website settings).
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 * @author Asim Liaquat  <asim@byng.co>
 */
final class Asset extends AbstractViewHelper
{
    const ASSET_DIR = "/website/asset";
    const STATIC_DIR = "/website/static";
    
    /**
     * @var Memoizer
     */
    private $memoizer;


    /**
     * Asset constructor.
     *
     * @param Memoizer $memoizer
     */
    public function __construct(Memoizer $memoizer)
    {
        $this->memoizer = $memoizer;
    }
    
    /**
     * Returns the absolute path to an asset
     *
     * @param string $filename
     * @param string $dir
     * @return string
     */
    public function asset($filename, $dir = self::STATIC_DIR)
    {
        // @todo CDN support?
        $filename = $this->normaliseFilename($filename);
        $contentsHash = $this->getContentHash($filename);
        
        return $this->getWebPath($filename, $dir) . "?cb=" . $contentsHash;
    }

    private function getContentHash($filename)
    {
        // We don't want to be looking up information about files on disk every request. If we can
        // cache this, on top of making things faster, it may also remove this as an attack vector.
        return $this->memoizer->memoize(__METHOD__ . $filename, function() use ($filename) {
            $filesystemPath = $this->getFilesystemPath($filename);

            if (!file_exists($filesystemPath)) {
                // Of note, this will only be called if the cache misses
                Logger::error(sprintf(
                    "Could not find asset '%s'. Defaulting to random hash.",
                    $filesystemPath
                ));

                return crc32(rand());
            }

            return crc32(file_get_contents($filesystemPath));
        }, Memoizer::LIFETIME_STANDARD);
    }

    /**
     * Get the path to a given file in the filesystem (assuming it exists).
     *
     * @param string $filename
     * @return string
     */
    private function getFilesystemPath($filename)
    {
        return PIMCORE_WEBSITE_PATH . "/static/" . $filename;
    }

    /**
     * Get the path to a given file that will be publicly accessible via the web (assuming it
     * exists).
     *
     * @param string $filename
     * @param string $dir
     * @return string
     */
    private function getWebPath($filename, $dir)
    {
        return $this->view->serverUrl() . $dir . "/" . $filename;
    }

    /**
     * Normalise a given filename to a static asset, so it is just a relative file URL for something
     * in the /website/static folder.
     *
     * @param string $filename
     * @return string
     */
    private function normaliseFilename($filename)
    {
        return preg_replace("#^/?website/static/?#", "", rtrim($filename, "/"));
    }
}
