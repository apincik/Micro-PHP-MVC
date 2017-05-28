<?php

namespace Darkside\Application;

use Views\View;
use \Smarty;


class Template
{

    private $smartyEngine;


    public function __construct()
    {
        $this->smartyEngine = new Smarty();
        $this->smartyEngine->setCacheDir("./cache/template/");
        $this->smartyEngine->setCompileDir("./cache/template/");
        $this->smartyEngine->caching = FALSE;
        $this->smartyEngine->force_compile = TRUE;
        $this->smartyEngine->debugging = FALSE;
    }


    /**
     * @param $name
     * Render template
     */
    public function render($name)
    {
        $templatePath = VIEW_PATH . $name . '.tpl';
        $this->smartyEngine->display($templatePath);
    }


    /**
     * @param $name
     * @param $value
     * Overloaded for assigning variables to template
     */
    public function __set($name, $value)
    {
        $this->smartyEngine->assign($name, $value);
    }


}
