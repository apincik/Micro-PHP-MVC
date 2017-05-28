<?php

require_once(__DIR__ . '/../vendor/Darkside/Loaders/Autoloader.php');

$autoloadFunction = function($className) {

    $paths = [ "app/", "vendor/"];
    $className = str_replace("\\","/",$className);
    $class = $className . ".php";

    foreach ($paths as $path) {
        $filePath = __DIR__ . '/../' . $path . $class;

        if(file_exists($filePath)) {
            include_once($filePath);
            break;
        }
    }
};

$autoloader = new \Darkside\Loaders\Autoloader();
$autoloader->register($autoloadFunction);