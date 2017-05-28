<?php

namespace Darkside\Application;

class Container
{

    /**
     * @var array
     * Array of registered services and objects
     */
    private $container = array();


    public function getService($name)
    {
        if(isset($this->container[$name]) == FALSE) {
            throw new \Exception("Trying to get unregistered service named $name");
        }

        return $this->container[$name];
    }


    public function register($name, $value)
    {
        $this->container[$name] = $value;
    }


    public function unregister($name)
    {
        unset($this->container[$name]);
    }


}