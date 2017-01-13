<?php

namespace PVV\helpers;

use PVV\exception\CustomException;
 
/** 
* Class Url
* @package PVV\helpers
*/
class Url
{
    /**
     *
     * @var string
     */
    public $content;
    /**
     *
     * @var array
     */
    public $urls = [];

    public function convert()
    {
        $this->urls = [];        
        $tempData = explode("\n", $this->content);
        if (count($tempData)) {
            foreach ($tempData as $url) {
                $url = trim($url);
                if (strlen($url)) {
                    $this->urls[] = $url;
                }
            }
        }
    }   

    public function check() 
    {
        if (count($this->urls)) {
            foreach ($this->urls as $key => $url) {
                $headers = @get_headers($url);
                try {
                    if (!preg_match("/200 OK/i", $headers[0])) {
                        unset($this->urls[$key]);
                        throw new CustomException("Incorrect URL <em>" . $url . "</em>");
                    }
                } catch (CustomException $e) {
                    $e->logError();
                }
            }
        }
    }

    /**
     * 
     * @param string $content
     */
    public function set($content)
    {
        $this->content = $content;
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
