<?php

class Model{


    public $view;

    public function __construct(){
        echo "This is a test from Model class";
        $this->view =new View();

    }

}





?>