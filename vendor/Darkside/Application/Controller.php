<?php

namespace Darkside\Application;


class Controller
{

    public $template;

    /**
     * @var Container
     * Application context
     */
    private $context;


    public function __construct()
    {
        $this->template = new Template();
    }


    public function setContext(Container $container)
    {
        $this->context = $container;
    }


    public function getContext()
    {
        return $this->context;
    }
    

}
