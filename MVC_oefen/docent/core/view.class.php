<?php
namespace core;

class View{
    private $template; // instance variable template
    private $vars; // array vars

    public function __construct(){ 
        $this->vars = [];
    }

    public function setTemplate($value){
        $this->template = '../templates/' . $value . '.template.php';
    }

    public function add($key, $value){
        $this->vars[$key]=$value; // adding an key and value to the vars array
    }

    public function render(){ //function render calls the vars array and the tem
        extract($this->vars); // if you have an array and you use extract
        // then you can echo the values of this array using the $ (and the key)
        require $this->template;// $this->template is an html page
    }
    
}
