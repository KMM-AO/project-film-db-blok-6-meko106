<?php

namespace app\models;

use core\Model;
use PDO;

class brouwer extends Model{
    const TABLE_NAME= 'brouwers';

    public function __construct(){
        parent:: __construct();
    }


    public function setId($value){
        $this->setDataField['id']= $value;
    }




}







