<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 */

namespace app\controllers;

use \core\View;
use \core\Json;
use \core\Token;
use \core\Session;

abstract class Controller
{
    /**
     * Het view object, wordt alleen gebruikt voor html-responses. 
     */
    protected $view;
    
    /** 
     * Het json object, wordt alleen gebruikt voor json-responses.
     */
    protected $json;
    
    /** 
     * Het token object voor authenticatie.
     * Een token object is een Model; tokens worden opgeslagen in de database.
     */
    protected $token;
    
    /**
     * Het session object
     */
    protected $session;
    
    /**
     * De constructor.
     * Initialiseert alle properties.
     */
    public function __construct()
    {
        $this->session = Session::getInstance();

        $this->json = new Json();

        $this->token = new Token();        
        $this->token->authenticate();

        $this->view = new View();
        
        $this->view->add('_message', $this->session->getOnce('message'));
        
        if ($this->token->isValid()) 
        {
            $this->view->add('_authuser', $this->token->getUser());
        }
    }

    /**
     * method voor interne (= binnen de applicatie) redirects
     */
    protected function redirect($url)
    {
        $webroot = \core\Router::getInstance()->getWebroot();        
        
        header('location: ' . $webroot . $url);
        die();
    }
    
}