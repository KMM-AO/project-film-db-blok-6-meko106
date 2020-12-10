<?php

namespace core;

class Router{
    private static $instance; //private
    private $allowed_routes;
    private $request;
    private $active_route;
    private $webroot;

    private function __construct(){}
    private function __clone(){}
    
    
    public static function getInstance(){
        if (!isset(self::$instance)){
            self::$instance=new self();
        }
        return self::$instance;
    }

    private function getAllowedRoutes(){
        if (!isset($this->allowed_routes)){
            require '../config/routes.conf.php';
        }
        return $this->allowed_routes;
        //it returns an array with Route objects containg 
        // $requrl,method,$controllerclass,$controller_method
    }
    
    
    private function getRequest(){
        if (!isset($this->request)){
            $this->request = new Request($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
        }
        return $this->request;
    }

    public function getWebroot(){ 
        if(!isset($this->webroot)){
            $script = $_SERVER['SCRIPT_NAME'];
            //by project_jaar2
            $this->webroot = dirname($script);

            if($this->webroot != '/'){
                $this->webroot .= '/';
            }
        }
        return $this->webroot;
    }


    private function matchRequest(){
        $match = false; // match is standard false
        foreach ($this->getAllowedRoutes() as $route){// each $route is an route object
            if ($route->matches($this->getRequest()  ) ){ //if route object->matches(the done request)
                //getReques returns an Request object
                $this->active_route = $route;
                $match = true;
            }
        }
        return $match; // active_route is the selected route object
    }


    public function go(){
        if (!$this->matchRequest()){ // if the done request does not match the allowed requests
            $view = new View();
            $view->setTemplate('404');
            $view->render();
        }else{
            $this->active_route->deploy();
        }
    }


}