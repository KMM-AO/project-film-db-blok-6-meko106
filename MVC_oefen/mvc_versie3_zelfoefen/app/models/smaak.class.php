<?php

namespace app\models;

use core\Model;
use core\Database;
use PDO;

class Smaak extends Model {

    /** de bijbehorende database-tabel */
    const TABLENAME = 'smaken';

    public function __construct()
    {
        /**
         * Roep de parent-constructor aan met ��n optionele parameter:
         * primary-key-definitie als een array met twee elementen [naam, pdo-paramtype]
         *   default is ['id', PDO::PARAM_INT]
         */
        parent::__construct();
    }

    /** setter voor de id */
    
    public function setId($value){
        $this->setDataField('id', $value);
    }

    /** static methods */
    
    static public function indexByProduct($id_product) {
        $pdo = Database::getInstance()->getPdo();

        $query = 
        '
            SELECT smaken.*
            FROM product_smaak
            JOIN smaken ON smaken.id = product_smaak.id_smaak
            WHERE product_smaak.id_product = :id_product
        ';
        
        $statement = $pdo->prepare($query);
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

