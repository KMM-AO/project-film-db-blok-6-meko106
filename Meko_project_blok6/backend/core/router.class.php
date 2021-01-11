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
        // gebruiken we niet
    }
    
    /**
     * getter voor het singleton object van de class Router
     */
    public static function getInstance(){ //returns as self object (from the same class)
        if (!isset(self::$instance)){  
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /** GETTERS */

    
    private function getRequest(){
        if (!isset($this->request)){
            $this->request = new Request($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
        }
        return $this->request;
    }

    public function getWebroot(){
        if (!isset($this->webroot)){
 
            $script = $_SERVER['SCRIPT_NAME'];
            
            /**
             * de webroot is de directory waarin $script zich bevindt
             */
            $this->webroot = dirname($script);
            
            /**
             * voeg een / toe, maar alleen als $webroot ongelijk is aan '/'
             */
            if ($this->webroot != '/') {
                $this->webroot .= '/';
            }
        }
        return $this->webroot;
    }

    /**
     * Vergelijk de gedane request met toegestane requests
     * retourneert true of false
     * 
     * Let op: deze method vindt de EERSTE route die overeenkomt met de request
     */
    private function matchRequest(){
        require '../include/routes.conf.php';
        foreach ($this->routes as $route){
            if ($route->matches($this->getRequest())){
                $this->active_route = $route;           // onthoud gevonden route
                return true;                            // stop met zoeken
            }
        }
        return false;
    }
    
    /**
     * voert de requestafhandeling uit
     */
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