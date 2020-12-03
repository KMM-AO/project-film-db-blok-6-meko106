<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 */

namespace app\controllers;

use \core\View;

abstract class Controller
{
    /** de view property */
    protected $view;
    
    public function __construct()
    {
        $this->view = new View();
    }
}