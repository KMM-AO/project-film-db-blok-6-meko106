<?php

namespace core;


class View{

    private $template;

    public function __construct(){

    }

    public function setTemplate($template){
        $this->template="../templates/".$template.'.template.php';
    }


    public function render(){
        require $this->template;
    }    

}









?>