<?php

namespace services;

use \Darkside\Factories\IFactory;
use \Darkside\Router\SimpleRouter;


class SimpleRouterFactory implements IFactory
{


    public function create()
    {
        return new SimpleRouter();
    }


}