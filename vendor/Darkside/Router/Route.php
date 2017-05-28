<?php

namespace Darkside\Router;


class Route {
    
    public $pattern;
    public $link;
 
    /**
     * 
     * @param type $pattern string
     * @param array $link array
     */
    public function __construct($pattern, array $link) {
        $this->pattern = $pattern;
        $this->link = $link;
    }
    
    
}
