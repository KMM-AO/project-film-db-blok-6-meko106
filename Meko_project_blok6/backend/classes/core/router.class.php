<?php





class Router{

    private static $instance;

    public function __construct(){

    }



    public function getInstance(){ // should be one time object
        if(!isset(self::$instance)){
            self::$instance=new self();
        }
        return self::$instance;
    }


    public function findTheWebroot(){
        $


    }



    public function go(){

    }





}