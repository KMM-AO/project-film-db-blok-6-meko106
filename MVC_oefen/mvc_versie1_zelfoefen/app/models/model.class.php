<?php

use \core\Database;

abstract class Model{

    public $pdo;

    public function __construct(){
        $this->pdo=Database::getInstance()->getPdo();

    }

    public function getData(){
        return $this->data;
    }

    public function getDataField($naam){
        return $this->data[$naam];
    }

    public function setData($value){
        foreach($value as &$str){
            $str=utf8_decode($str);
        }
        $this->data=$value;
    }

    public function setDataField($naam, $value){
        $this->data[$naam]= $value;   
    }







}





