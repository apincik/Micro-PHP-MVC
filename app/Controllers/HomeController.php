<?php

namespace Controllers;

use \Darkside\Application\Controller;


class HomeController extends Controller
{


    public function __construct()
    {
        parent::__construct();
    }


    public function renderDefault()
    {
       $this->template->content = '<p>HomeController -> default page !</p>';
       $this->template->render('Home/index');
    }
    
}