<?php



class View{

    public $vars;

    public $template;

    public function __construct(){

        $this->vars=[];
    }

    public function add($key,$value){
        $this->vars[$key]=$value;
    }

    public function render(){

    }






}