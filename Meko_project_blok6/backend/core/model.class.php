<?php

namespace core;

use \core\Database;
use PDO;

abstract class Model {
    
    
    protected $pdo;        
    
    /** private properties */

    private $data;          
    
    private $primary_name; 
    
    private $primary_type;  
    
    private $errors;      





    public function __construct(){
        $this->pdo = Database::getInstance()->getPdo();


    }
   
    public function getData(){
        return $this->data;
    }

    protected function getDataField($name)
    {
        return $this->data[$name] ?? NULL;
    }
    
    protected function getPrimaryValue(){
        return $this->getDataField($this->primary_name);
        //return the id (the primare_name is id)
    }
    

    public function __get($name){
        return $this->getDataField($name);
    }
    
    protected function setData($value){
        foreach ($value as &$str){
            $str = utf8_encode($str);
        }
        $this->data = $value;
    }
    
    protected function setDataField($name, $value){
        $this->data[$name] = $value;
    }

    protected function setError($name, $value){
        $this->errors[$name] = $value;
    }

    public function getErrors(){// it returns the errors array
        return $this->errors ?? [];
    }
    
    public function isValid(){ 
        return count($this->getErrors()) == 0;
    }


    public function index(){
        $class=get_called_class();
        $pdo=Database::getInstance()->getPdo();
        $query='SELECT * FROM '.$class::TABLE_NAME;
        $stmt=$pdo->prepare($query);
        $stmt->execute();
        $records=$stmt->fetchAll(PDO::FETCH_ASSOC);


        return $records;

    }



    

}