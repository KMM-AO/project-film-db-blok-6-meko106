<?php



namespace core;

class View{
    

    private $template;
    
    private $vars;

    public function __construct(){ //when making a new object, a vars empty array is also made
        $this->vars = [];
        $this->add('webroot', Router::getInstance()->getWebroot());
        //add() adds an key and value to the vars array 
    }


    public function setTemplate($value){
        $this->template = '../templates/' . $value . '.template.php';
    }
    

    public function add($key, $value){
        $this->vars[$key] = $value;
    }
    
 
    public function render(){
        extract($this->vars);
        require $this->template;
    }
}


