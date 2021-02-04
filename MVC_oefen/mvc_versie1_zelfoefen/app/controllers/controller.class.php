<?php

namespace app\controllers;

use \core\View;

abstract class controller{ // controller class has a view property
    public $view;

    public function __construct(){
        $this->view=new View();   
    }

}