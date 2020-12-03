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
        $this->data=$value;
    }
    public function getId(){
        return $this->id;
    }
    // public function setId($id){
    //     $this->id=$id;
    // }

    public function getFromData($value){
        return $this->data[$value];
    }

    public function setIdField($value){
        $this->data['id']=$value;
    }

    public function getIdField(){
        return $this->data['id'];
    }

    public function setDataField($name,$value){
        $this->data[$name]=$value;
    }




}