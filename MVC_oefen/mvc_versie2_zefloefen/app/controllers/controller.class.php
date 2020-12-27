<?php

namespace app\controllers;

use \core\View;
use \core\Json;
use \core\Token;


abstract class controller{ // controller class has a view property
    public $view;
    public $token;
    public $json;

    public function __construct(){
        $this->view=new View();   
        $this->json=new Json();
        $this->token=new Token();
    }

}