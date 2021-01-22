<?php

namespace core;

use \core\Database;
use PDO;

abstract class Model {
    
    
    protected $pdo;        
    private $data;              
    private $primary_name; 
    private $primary_type;  
    
    public $errors;      





    public function __construct($primary_def = ['id', PDO::PARAM_INT]){
        $this->pdo = Database::getInstance()->getPdo();
        
        $this->primary_name = $primary_def[0]; 
        $this->primary_type = $primary_def[1];
    }
   
    public function getData(){
        return $this->data;
    }

    public function setId($id){
        $this->setDataField('id',$id);
    }

    public function getId(){
        return $this->getDataField('id');
    }

    public function setData($data){
        $this->data=$data;
    }

    protected function getDataField($name){
        return $this->data[$name] ?? NULL;
    }
    
    protected function setDataField($name, $value){
        $this->data[$name] = $value;
    }

    public function setError($value,$error){
        $this->errors[$error]=$value;
    }

    public function getErrors(){
        return $this->errors ?? [];
    }

    public function isValid(){
        return $this->errors == 0 ;
    }


    public static function index(){
        $class=get_called_class();
        $pdo= Database::getInstance()->getPdo();
        $query='SELECT * FROM '.$class::TABLENAME;
        $stmt=$pdo->prepare($query);
        $stmt->execute();
        $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $records;

    }

    public function load(&$success){  //getting the film using the id
        $query = 
        '
            SELECT *
            FROM ' . $this::TABLENAME . '
            WHERE id = :id
        ';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $this->getId() );   //So here it is PARAM_INT
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        $success = ($data != false);
        if ($success){
            $this->setData($data);
            return $this->data;
        }
    }
}