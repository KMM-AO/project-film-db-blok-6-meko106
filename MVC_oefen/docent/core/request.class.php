<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 */

namespace core; 

class Request{
    
    private $uri;
    private $method;
    
    public function __construct($uri, $method){

        $uri = urldecode($uri);
        $this->uri = substr($uri, strlen(Router::getInstance()->getWebroot()));
        $this->method = $method;
    }
    
    public function getMethod(){
        return $this->method;
    }
    
    public function getUri(){
        return $this->uri;
    }
    
    
}