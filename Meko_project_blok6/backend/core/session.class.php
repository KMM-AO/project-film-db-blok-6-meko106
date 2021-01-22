<?php


namespace core;

class Session{
  
    private static $instance;

    
    private function __construct(){
        session_start();
    }


    private function __clone(){

    }
    
    public static function getInstance(){
        if (!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function addToSession($key,$value){
        $_SESSION[$key]=$value;
    }

    public function remove($key){
        unset($_SESSION[$key]);
    }    
 
    public function get($key){
        return $_SESSION[$key] ?? null;
    }
    
    public function getOnce($key){
        $value = $this->get($key);
        if (isset($value)){
            $this->remove($key);
        }
        return $value;
    }
}