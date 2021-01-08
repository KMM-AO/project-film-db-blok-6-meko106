<?php


abstract class Model{  //main class

    private $data;
    protected $pdo;


    public function __construct(){
        $this->pdo=Database::getInstance()->getPdo();

    }


    public function setDataField($key,$value){
        $this->data[$key]=$value;
    }



    public function index(){  //get using class::tableName
        $pdo=Database::getInstance()->getPdo();
        $class=get_called_class();
        $query='SELECT * FROM '.$class::TABLE_NAME.' ';

        $stmt= $pdo->prepare($query);
        $stmt->execute();
        $records= $stmt->fetchAll(PDO::FETCH_ASSOC);


        
    }





}