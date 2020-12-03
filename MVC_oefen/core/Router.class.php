<?php

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


    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance=new self();
        }return self::$instance;
    }

    public function getAllowedRoutes(){
        if(!isset($this->allowed_routes ) ){
            require '../config/routes.conf.php';
        }
        return $this->allowed_routes;
    }

    public function getRequest(){
        if(!isset($this->request)){
            $this->request= new Request($_SERVER['REQUEST_URI'] , $_SERVER['REQUEST_METHOD']);
        }
        return $this->request;
    }

    public function getWebroot(){
        if(!isset($this->webroot)){
            $script=$_SERVER['SCRIPT_NAME'];
            $this->webroot=dirname($script);
            if($this->webroot !='/'){
                $this->webroot.='/';
            }
            return $this->webroot;
        }
    }


    private function matchRequest(){
        $match=false;
        foreach($this->getAllowedRoutes() as $route){
            if($route->matches($this->getRequest())){
                $this->active_route=$route;
                $match=true;
            }
        }
        return $match;
    }

    public function go(){
        if(!$this->matchRequest()){
            $view=new View();
            $view->setTemplate('404.php');
            $view->render(); //only showing the content
        }else{
            $this->active_route->deploy();
        }
    }
}





?>