<?php

namespace app\controllers;

use \core\View;
use core\Session;
use core\Json;
use core\Token;

abstract class Controller{
 
    protected $view;    



    public function __construct(){

        $this->view = new View();


    }


}