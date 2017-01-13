<?php

namespace PVV\sys;

/**
* Class Logger
* @package PVV\sys
*/
class Logger
{
    const SUCCESS = 1;
    const ERROR = 2;
    
    /**
     *
     * @var object
     */
    protected static $instance;
    /**
     *
     * @var array
     */
    protected static $data = [];

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * 
     * @param type $message
     * @param type $type
     */
    public function set($message, $type = self::SUCCESS)
    {
        if ($type == self::SUCCESS) {
            $message = '<p class="text-success">Success: ' . $message . '</p>';
        } elseif ($type == self::ERROR) {
            $message = '<p class="text-danger">Error: ' . $message . '</p>';
        }
        self::$data[] = $message;
    }

    public function get()
    {
        return self::$data;
    }

    public function clear()
    {
        self::$data = [];
    }

    private function __clone()
    {

    }

    private function __wakeup()
    {

    }

}
