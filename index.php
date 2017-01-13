<?php

use PVV\Application;
 
$loader = require( __DIR__ . '/vendor/autoload.php' );
$loader->addPsr4( 'PVV\\', __DIR__ . '/src/' );
 
define('ROOT_PATH', dirname(__FILE__));

$appication = new Application();
$appication->run();
