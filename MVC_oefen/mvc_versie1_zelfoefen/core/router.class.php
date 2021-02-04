<?php

namespace core;

class Router{
    private static $instance;
    private $allowed_routes;
    private $webroot;
    
    
    public function getInstance(){
        if(!isset(self::$instance )){
            self::$instance=new self();
        }
        return self::$instance;
    }

    public function getAllowedRoutes(){
        if(!isset($this->allowed_routes)){
            require '../config/allowed_routes.php';
        }
        return $this->allowed_routes;
    }


    public function getRequest(){
        if(!isset($this->request)){ //index.php
            $this->request=new Request($_SERVER['REQUEST_URI'],$_SERVER['REQUEST_METHOD']);
        }
        return $this->request;
    }


    public function getWebroot(){//the webroot is the page after the request uri
        if(!isset($this->webroot)){
        $script=$_SERVER['SCRIPT_NAME'];
        $this->webroot=dirname($script);
        if($this->webroot != '/' ){ //
            $this->webroot .= '/' ;
        }
    }
    return $this->webroot;
}


    public function matchRequest(){
        $match=false;
        foreach($this->getAllowedRoutes() as $route){
            if($route->matches($this->getRequest() )){
                $this->active_route=$route;
                $match=true;
            }
        }
        return $match;
    }



    public function go(){
        if(!$this->matchRequest()){
            $view=new View();
            $view->setTemplate('error_page');
            $view->render();
        }else{
            $this->active_route->deploy();
        }
    }
}