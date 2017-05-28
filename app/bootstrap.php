<?php

require_once(__DIR__ . '/autoload.php');
require_once(__DIR__ . '/config/config.php');
require_once(__DIR__ . '/../vendor/Smarty/Smarty.class.php');
require_once(__DIR__ . '/../vendor/autoload.php');


use \Darkside\Application\Application;
use \Darkside\Config\Config;

$application = new Application($configureServices);
$application->run();

