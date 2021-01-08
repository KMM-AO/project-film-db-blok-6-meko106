<?php





class Router{

    private static $instance;
    private $webroot;

    private $request;

    public function __construct(){

    }


    public function getCurrentRequest(){
        $this->request=new Request($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
        return $this->request;
    }


    public function matchRequest(){
        
    }








  



    public function getInfo(){ //checking if the done r
        if(!matchRequest()){
            $view=new View();
            $view->setTemplate('404');
            $view->call();
        }else{

        }
    }





}