<?php



namespace core;

class Router{
    
    private static $instance;
    
  
    private $allowed_routes;


    private $request;

    private $active_route;
    

    private $webroot;
    
  
    private function __construct(){  
    }
    
    private function __clone(){
    }
    
   
    public static function getInstance(){ //returns as self object (from the same class)
        if (!isset(self::$instance)){  
            self::$instance = new self();
        }
        return self::$instance;
    }
    

    
    private function getRequest(){
        if (!isset($this->request)){
            $this->request = new Request($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
        }
        return $this->request;
    }

    public function getWebroot(){
        if (!isset($this->webroot)){
            $script = $_SERVER['SCRIPT_NAME'];
            $this->webroot = dirname($script);
            
            if ($this->webroot != '/') {
                $this->webroot .= '/';
            }
        }
        return $this->webroot;
    }


    private function matchRequest(){
        require '../include/routes.conf.php';
        foreach ($this->routes as $route){
            if ($route->matches($this->getRequest())){
                $this->active_route = $route;           
                return true;                            
            }
        }
        return false;
    }
    

    public function go(){
        if (!$this->matchRequest()){
            $view = new View();
            $view->setTemplate('404');//$tgis->template= ../tempalates/404.template.php
            $view->render();// require $this->template
        }else{
            $this->active_route->deploy();
        }
    }
}