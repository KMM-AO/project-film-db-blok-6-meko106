<?php

namespace app\models;


class Smaak extends Model{

    const TABLE_NAME= 'smaken';

    public function __construct(){
        parent:: __construct();
    }

    public function setId($value){
        $this->setDataField['id']=$value;
    }

    public function indexByProduct($id_product){
        $pdo=Database::getInstance()->go();

        $query
        '
        SELECT smaken.*
        FROM product_smaak
        JOIN smaken ON smaken.id=product_smaak.id_smaak
        WHERE product_smaak.id_product= :id_product
        ';

        $stmt= $pdo->prepare($query);
        $stmt->bindValue(':id_product', $id_product, PDO::PARAM_INT);
        $stmt->execute();
        $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects=[];
        foreach($records as $record){
            $object= new self();
            $object->setData($record);
            $objects[]=$object;
        }
        return $objects;
    }
}








?>