<?php

namespace PVV\exception;

use PVV\sys\Logger;
 
/** 
* Class CustomException
* @package PVV\exception
*/
class CustomException extends \Exception 
{

    public function logError() 
    {
        Logger::getInstance()->set($this->getMessage(), Logger::ERROR);
    }

}
