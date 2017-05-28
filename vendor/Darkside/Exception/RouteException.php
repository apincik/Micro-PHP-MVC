<?php

namespace Darkside\Exception;


class RouteException extends \Exception {
    
    public function __construct($message) {
        
        $this->message = $message;
    }
    
}

