<?php

namespace Darkside\Router;


class SimpleRouter implements IRouter
{

   
    /**
     * Create new instance of controller.
     * @param string $controller string
     * @return \controller object
     */
    /*private function initController($controller)
    {
        $controller = "\\Controllers\\" . $controller . 'Controller';
        return new $controller("wtf");
    }*/


	public function match($request)
    {
		$controller = $request[0]; //$this->initController($request[0]);
		$method = ucfirst($request[1]);
		$args = isset($request[2]) ? $request[2] : array();
		
		return array(
			"controller" => $controller,
			"method" => $method,
			"args" => $args,
		);
	}


}
