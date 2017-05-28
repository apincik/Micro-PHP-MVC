<?php

namespace Darkside\Application;

use Darkside\Database\Connection;
use Darkside\Database\Context;
use Darkside\Http;
use Darkside\Router\SimpleRouter;

class Application
{

    const META_ROUTER = "router";
    const META_REQUEST = "request";
    const META_RESPONSE = "response";
    const META_DATABASE = "database";

    private $container;


    public function __construct(array $configureServices)
    {
        $this->container = new Container();
        $this->configure($configureServices);
        $this->container->register("request", new Http\Request());
        $this->container->register("response", new Http\Response());
    }


    /**
     * @param $configureServices
     * @TODO add reflection with namespace possibilities
     */
    public function configure($configureServices)
    {
        foreach($configureServices as $key => $configuration)
        {
            if($key == self::META_DATABASE) {
                $dbConnection = new Connection(
                    $configuration["options"]["db_name"],
                    $configuration["options"]["db_user"],
                    $configuration["options"]["db_password"],
                    $configuration["options"]["db_host"],
                    $configuration["options"]["db_driver"]
                    );
                $context = new Context($dbConnection);
                $this->container->register("database", $context);
            }
        }
    }


    /**
     * Run application
     */
    public function run()
    {
        $this->startup();
        $this->processRequest();
        $this->shutdown();
    }


    private function startup()
    {
        if(isset($container[self::META_ROUTER]) === FALSE) {
            $router = new SimpleRouter();
            $this->container->register("router", $router);
        }
    }


    private function processRequest()
    {
        $requestResult = $this->router->match($this->request->getUrl());
        $controllerClassName = "\\Controllers\\" . $requestResult["controller"] . 'Controller';

        $controllerObject = new $controllerClassName();
        $controllerObject->setContext($this->container);
        $requestResult["controller"] = $controllerObject;


        $this->response->sendResponse($requestResult);

    }


    public function shutdown()
    {

    }


    public function __get($name)
    {
        return $this->container->getService($name);
    }


}
