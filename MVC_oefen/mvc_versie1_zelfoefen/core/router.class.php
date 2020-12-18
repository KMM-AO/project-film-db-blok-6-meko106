<?php

namespace core;

class Router{
    private static $instance;
    private $allowed_routes;
    
    
    
    public function getInstance(){
        if(!isset(self::$instance )){
            self::$instance=new self();
        }
        return self::$instace;
    }

    public function getAllowedRoutes(){
        if(!isset($this->allowed_routes)){
            require '../config/allowed_routes.php';
        }
        return $this->allowed_routes;
    }


    public function matchRequest(){
        $match=false;
        foreach($this->getAllowedRoutes() as $route){
            if($route->matches($Wthis->getRequest() )  ){
                
            }
        }

    }


    public function go(){
        if(!$this->matchRequest)
    }




}