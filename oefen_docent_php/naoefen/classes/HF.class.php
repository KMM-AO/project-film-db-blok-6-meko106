<?php


abstract class HF {
    public $pdo; //make the pdo class by show_json
    public $data; // data property


    public function __construct(PDO $pdo){
        $this->pdo=$pdo;
    }


    public function getData(){
        return $this->data;
    }

    public function setData($value){
        foreach($value as &$s){
            $s=utf8_encode($s);
        }
        $this->data=$value;
    }

    public function getFromData($value){
        return $this->data[$value] ?? NULL;
    }

    public function setId($value){
        $this->data['id']=$value;
    }



}