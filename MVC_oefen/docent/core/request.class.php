<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 */

namespace core;

class Request
{
    /** properties */
    private $uri;
    private $method;
    
    /** constructor */
    public function __construct($uri, $method)
    {
        // verwijder url-encodering (zoals %20 voor spaties):
        $uri = urldecode($uri);
        
        // bewaar alleen het deel van de uri vanaf de webroot:
        $this->uri = substr($uri, strlen(Router::getInstance()->getWebroot()));
        
        // bewaar de method (GET of POST)
        $this->method = $method;
    }
        
    /** GETTERS */
    public function getMethod()
    {
        return $this->method;
    }
    
    public function getUri()
    {
        return $this->uri;
    }
    
    
}