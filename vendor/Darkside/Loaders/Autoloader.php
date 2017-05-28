<?php

namespace Darkside\Loaders;


class Autoloader
{


    /**
     * @param $autoloadFunction
     * @throws Exception
     * Register autoload function
     */
    public function register($autoloadFunction)
    {
        if (function_exists('spl_autoload_register') === FALSE) {
            throw new \Exception('spl_autoload does not exist in this PHP installation.');
        }

        if(is_callable($autoloadFunction) === FALSE) {
            throw new \Exception("Passed autoload function is not callable.");
        }

        spl_autoload_register($autoloadFunction);
    }
}