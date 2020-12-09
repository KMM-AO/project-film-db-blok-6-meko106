<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 */

namespace app\controllers;

use \core\View; //require/include Vieuw class using use

abstract class Controller{ 
    protected $view;

    public function __construct(){
        $this->view = new View();
    }

    //when calling the Controller class
    //view object is made

}