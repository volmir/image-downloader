<?php

namespace PVV\models;

use PVV\sys\Logger;
use PVV\exception\CustomException;
 
/** 
* Class Downloader
* @package PVV\models
*/
class Downloader
{    
    /**
     *
     * @var string
     */
    public $path = '/static/upload/';
    /**
     *
     * @var array
     */
    public $urls = [];
    
    public function download() 
    {
        if (count($this->urls)) {
            foreach ($this->urls as $url) {
                $filename = basename($url);
                $filepath = ROOT_PATH . $this->path . $filename;
                try {
                    if (file_exists($filepath)) {
                        throw new CustomException("file <em>" . $filepath . "</em> exists");
                    } else {

                        $result = file_put_contents($filepath, file_get_contents($url));
                        if ($result) {
                            Logger::getInstance()->set("file <em>" . $filepath . "</em> downloaded successfully", Logger::SUCCESS);
                        } else {
                            throw new CustomException("file <em>" . $filepath . "</em> is not downloaded");
                        }
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
    public function setUrls($urls) 
    {
        if (is_array($urls) && count($urls)) {
            $this->urls = $urls;
        }
    }
}
