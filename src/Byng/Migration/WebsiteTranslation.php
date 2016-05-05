<?php

namespace Byng\Pimcore\Migration;

use Pimcore\Tool;
use Pimcore\Model\Translation\Website as SiteTranslation;

/**
 * Description of SharedTranslation
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
     */
    public function create(array $translations = [])
    {
        SiteTranslation::clearDependentCache();

        foreach ($translations as $key => $translations) {
            try {
                $t = SiteTranslation::getByKey($key);
            }
            catch (\Exception $e) {

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
     */
    public function update(array $translations = [])
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
            }
            catch (\Exception $e) {}
        }
    }
    
    /**
     * Delete a translation
     * 
     * @param string $key
     */
    public function delete($key)
    {
        $translation = SiteTranslation::getByKey($key);
        if ($translation) {
            $translation->delete();
        }
    }
    
}