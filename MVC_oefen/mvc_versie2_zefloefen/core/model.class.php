<?php

namespace core;

use \core\Database;
use PDO;

abstract class Model{

    protected $pdo;
    private $data;
    private $primary_name;
    private $primary_type;
    private $erros;


    public function __construct($primary_def= ['id', PDO::PARAM_INT] ){
        $this->pdo=Database::getInstance()->getPdo();
        $this->primary_name=$primary_def[0];
        $this->primary_type=$primary_def[1];
    }


    public function getData(){
        return $this->data;
    }

    public function getDataField($name){
        return $this->data[$name] ?? null;
    }

    public function setDataField($name, $value){
        $this->data[$name]=$value;
    }

    protected function setError($name, $value){
        $this->errors[$name] = $value;
    }
    
    public function getErrors(){
        return $this->errors ?? [];
    }
 
    public function isValid(){
        return count($this->getErrors()) == 0;
    }
    

    public function load(){
        $query='
        SELECT * FROM '.$this::TABLE_NAME. '
        WHERE '. $this->primary_name . ' = :pk
        ';

        $stmt=$this->pdo->prepare($query);
        $stmt->bindValue(':pk', $this->getPrimaryValue() , $this->primary_type );
        $stmt->execute();
        $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $succes=($data != false);
        if($succes){
            $this->setData($data);
        }
    }

}




?>