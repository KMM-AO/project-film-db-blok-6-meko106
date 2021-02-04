<?php



namespace core;

class Router{
    /**
     * static object van de class Router
     */
    private static $instance;
    
    /**
     * array met route-objecten; waarde wordt bepaald in configuratiefile config/routes.conf.php
     */
    private $allowed_routes;


    private $request;
    
    /**
     * de gevonden actieve route; object van de class Route
     */
    private $active_route;
    
    /**
     * de webroot; string met het absolute pad naar de webroot (de map public)
     */
    private $webroot;
    
    /**
     * private constructor blokkeert het gebruik van new om Router-objecten te maken
     */
    private function __construct(){  // private blokkeert het maken van router classs objecten
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
    
    private function getAllowedRoutes(){
        if (!isset($this->allowed_routes)){
            require '../config/routes.conf.php';
        }
        return $this->allowed_routes;
    }
    
    private function getRequest(){
        if (!isset($this->request)){
            $this->request = new Request($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
        }
        return $this->request;
    }

    public function getWebroot(){
        if (!isset($this->webroot)){
            /**
             * $_SERVER['SCRIPT_NAME'] is normaliter: /pad/naar/de/webroot/index.php, 
             * maar in principe is een andere filename dan index.php ook toegestaan. 
             * Dat kun je dan in .htaccess aanpassen.
             */
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
        foreach ($this->getAllowedRoutes() as $route){
            if ($route->matches($this->getRequest())){
                $this->active_route = $route;           // onthoud gevonden route
                return true;                            // stop met zoeken
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