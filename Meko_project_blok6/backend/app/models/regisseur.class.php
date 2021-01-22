<?php

namespace app\models;

use core\Model;


class Regisseur extends Model{



    public function __construct(PDO $pdo){
        parent:: __construct($pdo);
    }

  
    public function getId(){
        return $this->getFromData('id');
    }
    
    
    public function setId($value){
        $this->data['id']=$value; // it is about the data of the reg
    }

    

    public function getFromDB(){
        $query='SELECT * FROM persons WHERE id=:id';

        $stmt=$this->pdo->prepare($query);
        $stmt->bindValue(':id', $this->getId(), PDO::PARAM_INT );
        $stmt->execute();
        $records=$stmt->fetch(PDO::FETCH_ASSOC);
        $succes=($records!=false);
        if($succes){
            $this->setData($records);
        }else{
            echo "There were something went wrong";
        }
    }



}