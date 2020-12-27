<?php

namespace app\models;


class Stijl extends Model{

    const TABLE_NAME= 'stijlen';

    public function __construct(){
        parent:: __construct();
    }

    public function setId($value){
        $this->setDataField('id' , $value);
    }
    
    

}