<?php

namespace app\models;

class Product extends Model{

    const TABLE_NAME= 'producten';


    public function __construct(){
        parent:: __construct();
    }

    public function setId($value){
        $this->setDataFielf['id']=$value;
    }

    public function

}