<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 */

namespace app\controllers;

use \core\View;
use \core\Json;
use \core\Token;

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
     * Het token object, wordt alleen gebruikt bij geauthenticeerde api-calls.
     * Een token object is een Model; tokens worden opgeslagen in de database.
     */
    protected $token;
    
    /**
     * De constructor.
     * Initialiseert alle properties.
     */
    public function __construct()
    {
        $this->view = new View();
        $this->json = new Json();
        $this->token = new Token();
    }

}