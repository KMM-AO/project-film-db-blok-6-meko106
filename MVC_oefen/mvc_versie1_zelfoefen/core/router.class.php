<?php

namespace core;

class Router{
    private static $instance;
    private $allowed_routes;
    
    
    
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


    public function matchRequest(){
        $match=false;
        // foreach($this->getAllowedRoutes() as $route){
        //     if($route->matches($this->getRequest() )  ){
                
        //     }
        // }
        return $match;
    }



    public function go(){
        if(!$this->matchRequest()){
            $view=new View();
            $view->setTemplate('error_page');
            $view->render();
        }else{

        }

    }

}