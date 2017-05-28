<?php

namespace services;

use \Darkside\Factories\IFactory;
use \Darkside\Router;


class RouterFactory implements IFactory
{


    public function create()
    {
        $router =  new Router\Router();

        //$router->pushRoute(new Route('controller', array('controller' => NULL, 'method' => DEFAULT_METHOD)));
        /*$router->pushRoute(new Route('controller/#method/#id', array(
            'controller' => NULL,
            'method' => NULL,
            'id' => NULL
        )));*/
        //$router->pushRoute(new Route('controller/#method/#id', array('controller' => NULL, 'method' => NULL, 'args' => array('id' => NULL))));
        /*$router->pushRoute(new Route('#lang/controller/#method/#id', array(
            'controller' => 'article',
            'method' => NULL,
            'args' => array(
                'lang' => NULL,
                'id' => NULL,
                ),
        )));*/

        //$router->pushRoute(new Route('#controller/#method/#id', array('controller' => '', 'method' => '', 'id' => 0)));


        return $router;
    }


}