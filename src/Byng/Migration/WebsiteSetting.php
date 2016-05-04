<?php

namespace Byng\Pimcore\Migration;

use Pimcore\Model\WebsiteSetting as Setting;

/**
 * Description of WebsiteSetting
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
     * 
     * @param string     $name
     * @param string     $type
     * @param int|string $data
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
    }
    
    /**
     * 
     * @param string     $name
     * @param int|string $data
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
    }
    
    /**
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