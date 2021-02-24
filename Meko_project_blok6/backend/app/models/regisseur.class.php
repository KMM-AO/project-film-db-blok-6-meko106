<?php

namespace app\models;

use core\Model;
use core\Database; 
use PDO;

class Regisseur extends Model{


    public function __construct(){
        parent:: __construct();
    }

  
    public function getId(){
        return $this->getDataField('id_regisseur');
    }
    
    
    public function setId($value){
        $this->data['id']=$value; // it is about the data of the reg
    }

    

    public function getFromDB($id){
        $query='SELECT * FROM persons WHERE :id=id';
        $pdo=Database::getInstance()->getPdo();


        $stmt=$pdo->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT );
        $stmt->execute();
        $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $records;
    }



}