<?php

namespace PVV\helpers;

use PVV\exception\CustomException;
 
/** 
* Class Image
* @package PVV\helpers
*/
class Image 
{
    /**
     *
     * @var array 
     */
    public $extentions = [
        'jpeg', 
        'jpg', 
        'gif', 
        'png'
    ];
    /**
     *
     * @var array
     */
    public $urls = [];    

    public function check()
    {
        if (count($this->urls)) {
            foreach ($this->urls as $key => $url) {
                try {
                    $extention = pathinfo($url, PATHINFO_EXTENSION);
                    if (!in_array($extention, $this->extentions)) {
                        unset($this->urls[$key]);
                        throw new CustomException("Incorrect file extentions <em>." . $extention . "</em>");
                    }
                } catch (CustomException $e) {
                    $e->logError();
                }
            }
        }
    }
    
    /**
     * 
     * @param array $urls
     */
    public function set($urls)
    {
        $this->urls = $urls;
    }  
    
    /**
     * 
     * @return array
     */
    public function get()
    {
        return $this->urls;
    }  

}
