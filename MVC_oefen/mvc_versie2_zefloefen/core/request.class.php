<?php

namespace core;

class Request{ // by the request obj we give an uri and method as params
    private $uri;
    private $method;
    
    public function __construct($uri,$method){
        $uri=urldecode($uri);
        $this->uri=substr($uri, strlen(Router::getInstance()->getWebroot() ) );
        //uri
        $this->method=$method;
    }

    public function getMethod(){
        return $this->method;
    }

    public function getUri(){
        return $this->uri;
    }


}








?>