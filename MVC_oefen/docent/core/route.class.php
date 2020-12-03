<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 */

namespace core;

class Route
{
    /**
     * properties
     */
    private $request_url;
    private $request_method;
    private $request_parameters;
    
    private $controller_class;
    private $controller_method;

    /**
     * constructor
     */    
    public function __construct($request_url, $request_method, $controller_class, $controller_method)
    {
        $this->request_url = $request_url; 
        $this->request_method = $request_method;
        $this->controller_class = $controller_class;
        $this->controller_method = $controller_method;
    }
    /**
     * check of de route matcht met een request
     */
    public function matches(Request $request)
    {
        return $this->methodMatches($request->getMethod()) && $this->uriMatches($request->getUri());
    }
    
    private function methodMatches($method)
    {
        $ok = ($method == $this->request_method);
        return $ok;
    }
    
    private function uriMatches($uri)
    {
        $ok = preg_match('#^' . $this->request_url . '$#', $uri, $matches);
        if ($ok) {
            $this->request_parameters = array_slice($matches, 1);
        }
        return $ok;
    }
    
    /**
     * voer de code behorende bij de route uit
     */
    public function deploy()
    {
        //myVarDump($this);
        $class = '\\app\\controllers\\' . $this->controller_class;
        
        $controller = new $class();
        
        $callable = [$controller, $this->controller_method];
        
        call_user_func_array($callable, $this->request_parameters);
          
    }
    
}
