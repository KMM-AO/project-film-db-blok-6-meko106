<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 */

namespace core;

/**
 * De class Request is een container voor de twee eigenschappen die een request definiëren:
 * - een uri (alleen het deel vanaf de webroot)
 * - een method (GET of POST)
 */
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