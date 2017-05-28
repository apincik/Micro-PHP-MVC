<?php

/**
 *
 *
 * @TODO REFACTOR
 *
 *
 */


namespace Darkside\Router;


class Router implements IRouter {

    private $routes = array();
    private $routesCount = 0;
    private $link = array(
        'controller' => '',
        'method' => '',
        'args' => array(),
    );
    private $controller_index = -2;     //store helper controller route pattern index
    private $method_index = 0;         //store helper method route patter index
    
    
    /**
     * Return count of routes in array
     * @return type int
     */
    private function getRoutesCount() {
        return count($this->routes);
    }
    
    /**
     * Push route to route list
     * @param Route $route object
     */
    public function pushRoute(Route $route) {

        $this->routes[$this->routesCount] = $route;
        $this->routesCount++;
    }

    /**
     * Check if controller exists
     * @param type $controller string
     * @return type bool
     */
    private function checkControllerExists($controller) {
        $file = __DIR__ . '/../controllers/' . $controller . 'Controller.php';
        return file_exists($file);
    }
    
    /**
     * Check if method exists
     * @param string $method string
     * @param type $controller object
     * @return type bool
     */
    private function checkMethodExists($method, $controller) {
        //$controller = $controller . 'Controller';
        $method = 'render' . $method;
        return method_exists($controller, $method);
    }
    
    /**
     * Create new instance of controller.
     * @param string $controller string
     * @return \controller object
     */
    private function initController($controller) {

        $file = __DIR__ . '/../controllers/' . $controller . 'Controller.php';
        include_once $file;
        $controller = $controller . 'Controller';
        return new $controller;
    }
    
    /**
     * Return ErrorController object
     * @return type object
     */
    private function initError() { //) key) {
        return $this->initController(ERROR_CONTROLLER);
        //$this->link[$key] = $this->initController(ERROR_CONTROLLER);
    }
    
    /**
     * Method to find controller in URL parameters
     * @param type $url array
     * @param type $counter int
     * @return type object
     */
     private function parseController($url, $counter) {
        for($i=0; $i < $counter; $i++) {
            if ($this->checkControllerExists($url[$i]) == TRUE) {
                $this->controller_index = $i;
                return $this->initController($url[$i]);                              
            }
            return $this->initError();
        }
    }
    
    /**
     * Method to find method in URL parameters
     * @param type $url array
     * @param type $controller object
     * @param type $counter int
     * @return string 
     * @return NULL
     */
    private function parseMethod($url, $controller, $counter) {
        for($i=0; $i < $counter; $i++) {
            if ($this->checkMethodExists($url[$i], $controller) == TRUE) {
                $this->method_index = $i;
                return $url[$i];
            }
            
        }
        return NULL;
    }
    
    /**
     * Check for controller object init.
     * @param type $controller
     * @throws RouteException
     */
    private function checkControllerSet($controller) {
        if (is_object($controller) == FALSE) 
          throw new RouteException('Trying to lookup method without non-initialized controller ! Invalid Route !');                  
    }
    
    /**
     * Echo message
     * @param type $text mix
     */
    public function debug($text) {
        echo '<br>' . $text . '<br>';
        }
    
    public function match($params) {

        $routes_counter = 0;
        $matched = 0;  //matched params in URL and route
        $url_counter = count($params);
        $index = 0;
        $pindex = 0;
        
        foreach ($this->routes as $route) {
            
            $this->controller_index = -2;
            $this->method_index = 0;
            $routes_counter++;
            $matched = 0;
            $url = $params;
            $index = 0;
            $pindex = 0;
            $pattern = explode('/', $route->pattern);
            $counter = count($pattern);
            
           while(TRUE) {
               
                if ($pattern[$pindex][0] != '#') {

                    if ($pattern[$pindex] == 'controller') {
                        if ($route->link['controller'] != NULL) {
                            if ($this->checkControllerExists($url[$index]) == TRUE && $url[$index] != $route->link['controller']) {
                                break;
                            }               //no else to set route link, because it is set by default, route declaration
                            else { 
                                $route->link['controller'] = $this->initController($route->link['controller']);
                                $this->controller_index = $index;
                                $matched++;
                                $index++; 
                                $pindex++; }
                            
                       } else {
                            $route->link['controller'] = $this->parseController($url, $url_counter);
                            $matched++;
                            $index++;
                            $pindex++;
                        }
                    } elseif ($pattern[$pindex] == 'method') {
                        $this->checkControllerSet($route->link['controller']);
                        $route->link['method'] = $this->parseMethod($url, $route->link['controller'], $url_counter);
                        $matched++;
                        $index++;
                        $pindex++;
                        if($route->link['method'] == NULL && count($url) == 1) {
                            $matched--;
                            $route->link['method'] = DEFAULT_METHOD;
                        }
                        if ($route->link['method'] == NULL) {
                            $matched--;
                            break;
                        }
                    } else {
                        $route->link['args'][$pattern[$pindex]] = $url[$index];
                        $matched++;
                        $index++;
                        $pindex++;
                    }
                } else {
                    $key = substr($pattern[$pindex], 1);

                    if ($key == 'controller') {
                        throw new Exception('Controller cannot be signed as #controller !');
                    } elseif ($key == 'method') {         //non-compulsory method in link, but can be written !
                        $this->checkControllerSet($route->link['controller']);
                         $route->link['method'] = $this->parseMethod($url, $route->link['controller'], $url_counter);
                         $matched++;
                         $index++;
                         $pindex++;
                        if ($route->link['method'] == NULL) {
                            $index--;
                            $matched--;
                            $route->link['method'] == DEFAULT_METHOD;
                        }
                    
                    }
                    else {
                        if($this->checkControllerExists($url[$index]) == TRUE) {
                            $pindex++;
                        } else {
                            $route->link['args'][$key] = $url[$index];
                            $matched++;
                            $index++;
                            $pindex++;
                        }
                    }
                } //END OF ELSE
 
               if($index == $url_counter) {
                   $index--;
               }
               
               if($pindex == $counter) 
                   break;

            } //END OF WHILE LOOP
            
            
            if($matched >= count($url)) {
                
                if($this->controller_index > $this->method_index) {
                throw new RouteException('Invalid parameters order ! method / controller !');
            }
                return $route->link; 
            }
            
            elseif($routes_counter == $this->getRoutesCount()) {
                throw new RouteException('No route exist !');
            }
        }

         
    }

}
