<?php

namespace app\models;

use core\Model;
use PDO;

class Product extends Model {
    
    /** de bijbehorende database-tabel */
    const TABLENAME = 'producten';

    /** relatie-properties */
    /** RELATIONS */
    private $stijl;     // de 1-op-veel-relatie met stijlen, object van de class Stijl
    private $brouwer;   // de 1-op-veel-relatie met brouwers, object van de class Brouwer
    private $smaken;    // de veel-op-veel-relatie met smaken, array van objecten van de class Smaak
    public function __construct(){
        /**
         * Roep de parent-constructor aan met ��n optionele parameter:
         * primary-key-definitie als een array met twee elementen [naam, pdo-paramtype]
         *   default is ['id', PDO::PARAM_INT]
         */
        parent::__construct();
        // it is an child of the Model class
    }
    
    /** setter voor de id */
    
    public function setId($value){
        $this->setDataField('id', $value);
    }
    
    public function getStijl(){
        if (!isset($this->stijl)){
            $this->stijl = new Stijl();
            $this->stijl->setId($this->id_stijl);
            $this->stijl->load($success);
        }
        return $this->stijl;
    }
    
    public function getBrouwer(){
        if (!isset($this->brouwer)){
            $this->brouwer = new Brouwer();
            $this->brouwer->setId($this->id_brouwer);
            $this->brouwer->load($success);
        }
        return $this->brouwer;
    }
    
    public function getSmaken(){
        if (!isset($this->smaken)){
            $this->smaken = Smaak::indexByProduct($this->id);
        }
        return $this->smaken;
    }

    public function detachSmaak(Smaak $smaak = NULL){
        $query = '
            DELETE
            FROM product_smaak
            WHERE id_product = :id_product
        ';
        /** ... of alleen ��n relatie met een bepaalde smaak. */
        if (isset ($smaak)){
            $query .= ' AND id_smaak = :id_smaak';
        }
        
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id_product', $this->id, PDO::PARAM_INT);
        if (isset($smaak)){
            $statement->bindValue(':id_smaak', $smaak->id, PDO::PARAM_INT);
        }
        $statement->execute();
    }

}
