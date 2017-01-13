<?php

namespace PVV;
 
use PVV\sys\View;
use PVV\sys\Logger;
use PVV\models\Downloader;
use PVV\helpers\Image;
use PVV\helpers\Url;
 
class Application 
{
    
    public function __construct()
    {

    }    
    
    public function run() 
    {        
        if (isset($_REQUEST['images'])) {            
            $url = new Url();
            $url->set($_REQUEST['images']);
            $url->convert();
            $url->check();
            $urls = $url->get();
            
            $image = new Image();
            $image->set($urls);
            $image->check();
            $urls = $image->get();         
            
            $downloader = new Downloader();
            $downloader->setUrls($urls);
            $downloader->download();          
        }
        $this->renderMainPage();
    }    
    
    protected function renderMainPage() 
    {
        $images = '';
        if (isset($_REQUEST['images'])) {
            $images = $_REQUEST['images'];
        }
        
        $view = new View('views');
        $view->set('title', 'Image Downloader');
        $view->set('images', $images);
        $view->set('messages', Logger::getInstance()->get());
        $view->render('index.html');
    }

}
