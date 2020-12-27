<?php

namespace core;


class View{

    private $template;

    public function __construct(){

    }

    public function setTemplate($template){
        $this->template="../templates/".$template.'.template.php';
    }

    public function add($key, $value)
    {
        $this->vars[$key] = $value;
    }


    public function render(){
        extract($this->vars);
        require $this->template;
    }    

}









?>