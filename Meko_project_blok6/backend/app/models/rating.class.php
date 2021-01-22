<?php

namespace app\models;

use core\Model;
use core\Database;
use PDO;

class Rating extends Model{

    const TABLENAME='rating';

    public function __construct(){

        parent:: __construct();
    }


    public function setId($value){
        $this->setDataField('id',$value);
    }

    public function setIdUser($value){
        $this->setDataField('id_user', $value);
    }

    public function setIdProduct($value){
        $this->setDataField('value',$value);
    }

    public function setValue($value){
        $this->setDataField('value', $value);
    }


    public function save(){
        $this->validataValue();
        $this->validateIdProduct();

        if($this->isValid()){
            if($this->id !== null){
                $this->update();
            }else{
                $this->insert();
            }
        }
    }

    public function validataIdProduct(){
        $product=new Product();
        $product->setId($this->id_product);
        $product->load($succes);

        if(!$succes){
            $this->setError('id_product', 'produc bestaat niet (meer)');
        }
    }



    private function update(){
        $query=
        '
        UPDATE ratings SET value = :value, id_product = :id_prodcut, id_user = :id_user
        WHERE id = :id 
        ';

        $stmt= $this->pdo->prepare($query);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':id_product', $this->id_product, PDO::PARAM_INT);
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);
        $stmt->bindValue(':value', $this->value, PDO::PARAM_INT);
        $stmt->execute();
    }


    public function insert(){
        $query=
        '
        INSERT INTO ratings (id_product, id_user, value) VALUES (:id_product, :id_user, :value)
        ';

        $stmt=$this->pdo->prepare($query);
        $stmt->bindValue('id_product', $this->id_product, PDO::PARAM_INT);
        $stmt->bindValue('id_user', $this->id_user, PDO::PARAM_INT);
        $stmt->bindValue(':value', $this->value, PDO::PARAM_INT);
        $stmt->execute();

        $this->setId($this->pdo->lastInsertId());
    }


    static public function indexByUser(){
        $pdo=Database::getInstance()->getPdo();
        
        $query=
        '
        SELECT * FROM  ratings 
        WHERE id_user= :id_user
        ';


        $statement = $pdo->prepare($query);
        $statement->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $statement->execute();
        
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        
        foreach ($records as $record){
            $object = new self();
            $object->setData($record);
            $objects[] = $object;
        }
        return $objects;
    }
}

















?>