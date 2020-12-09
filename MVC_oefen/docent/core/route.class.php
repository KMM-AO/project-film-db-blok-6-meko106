<?php

namespace core;

class Route{
     private $request_url;
     private $request_method; // request method
     private $request_parameters;  // request mee meegestuurde parameters
     
     private $controller_class; // controller class
     private $controller_method; // controller method
     
     public function __construct($request_url, $request_method, $controller_class, $controller_method){
        $this->request_url = $request_url;                
        $this->request_method = $request_method;
        $this->controller_class = $controller_class;
        $this->controller_method = $controller_method;
    }
    
    
    public function matches(Request $request){
        return $this->methodMatches($request->getMethod()) && $this->uriMatches($request->getUri());
    }

    private function methodMatches($method){ // here we give the method name as parameter
        $ok = ($method == $this->request_method);// it returns true if the given method equals to requestmethod
        return $ok;
    }

    private function uriMatches($uri){//pregmatch returns 1 if the request_url exists in the $uri parameter
        $ok = preg_match('#^' . $this->request_url . '$#', $uri, $matches);
        if ($ok){ 
            $this->request_parameters = array_slice($matches, 1);
        } //$this.request_parameters=
        return $ok;
    }
    
    
    public function deploy(){
        $class = '\\app\\controllers\\'.$this->controller_class;
        $controller = new $class();
        $callable = [$controller, $this->controller_method];
        call_user_func_array($callable, $this->request_parameters);
    }

}
