<?php

namespace app\controllers;

use \core\View;

abstract class Controller{
 
    protected $view;    



    public function __construct(){

        $this->view = new View();


    }


}