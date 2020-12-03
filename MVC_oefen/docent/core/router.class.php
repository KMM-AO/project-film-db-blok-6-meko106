<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 */

namespace core;

class Router
{
    /**
     * static object van de class Router
     */
    private static $instance;
    
    /**
     * array met route-objecten
     */
    private $allowed_routes;

    /**
     * de gedane request
     */
    private $request;
    
    /**
     * de gevonden actieve route
     */
    private $active_route;
    
    /**
     * de webroot
     */
    private $webroot;
    
    /**
     * private constructor blokkeert het gebruik van new om Router-objecten te maken
     */
    private function __construct()
    {
        
    }
    
    /**
     * private clone-method
     */
    private function __clone()
    {
        // gebruiken we niet
    }
    
    /**
     * retourneert een object van de class Router zelf
     */
    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /** GETTERS */
    
    private function getAllowedRoutes()
    {
        if (!isset($this->allowed_routes))
        {
            require '../config/routes.conf.php';
        }
        return $this->allowed_routes;
    }
    
    private function getRequest()
    {
        if (!isset($this->request))
        {
            $this->request = new Request($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
        }
        return $this->request;
    }

    public function getWebroot()
    {
        if (!isset($this->webroot))
        {
            /**
             * $_SERVER['SCRIPT_NAME'] is normaliter: /pad/naar/de/webroot/index.php, 
             * maar in principe is een andere filename dan index.php ook toegestaan. 
             * Dat moet je dan in .htaccess aanpassen.
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
     * vergelijkt gedane request met toegestane requests
     * retourneert true of false
     */
    private function matchRequest(){
        $match = false;
        foreach ($this->getAllowedRoutes() as $route)
        {
            if ($route->matches($this->getRequest()))
            {
                $this->active_route = $route;
                $match = true;
            }
        }
        return $match;
    }
    
    /**
     * voert de requestafhandeling uit
     */
    public function go()
    {
        if (!$this->matchRequest())
        {
            $view = new View();
            $view->setTemplate('404');
            $view->render();
        }
        else
        {
            $this->active_route->deploy();
        }
    }
    
}