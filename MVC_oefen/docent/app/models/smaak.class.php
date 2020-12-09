<?php

namespace app\models;

use PDO;

class Smaak extends Model {

    const TABLENAME = 'smaken';

    public function __construct(){
        parent::__construct();
    }
    
    public function getId(){
        return $this->getDataField('id');
    }

    public function getNaam(){
        return $this->getDataField('naam');
    }


    public function setId($value){
        $this->setDataField('id', $value);
    }
    
    public function load(&$success){
        $query = 'SELECT * FROM smaken WHERE id = :id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $this->getId(), PDO::PARAM_INT);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        $success = ($data != false);
        if ($success){
            $this->setData($data);
        }
    }

    /** static methods */
    
    static public function indexByProduct($id_product) {
        $query = 
        'SELECT smaken.*
        FROM product_smaak
        JOIN smaken ON smaken.id = product_smaak.id_smaak
        WHERE product_smaak.id_product = :id_product
        ';
        $statement = Database::getInstance()->getPdo()->prepare($query);
        $statement->bindValue(':id_product', $id_product, PDO::PARAM_INT);
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

