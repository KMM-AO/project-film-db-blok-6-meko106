<?php

namespace app\models;

use PDO;

class Brouwer extends Model {
    
    const TABLENAME = 'brouwers';

    public function __construct()
    {
        /**
         * Roep de parent-constructor aan met ��n optionele parameter:
         * primary-key-definitie als een array met twee elementen [naam, pdo-paramtype]
         *   default is ['id', PDO::PARAM_INT]
         */
        parent::__construct();
    }

    /** getters */
    
    public function getId(){ 
        return $this->getDataField('id');
    }

    public function getNaam(){
        return $this->getDataField('naam');
    }

    /** setters */
    
    public function setId($value){
        $this->setDataField('id', $value);
    }

    /** database-acties */
    
    /** deze method kan in principe ook generiek gemaakt worden (net als Model::delete()) */
    public function load(&$success){
        $query = 
        '
            SELECT *
            FROM brouwers
            WHERE id = :id
        ';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $this->getId(), PDO::PARAM_INT);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        $success = ($data != false);
        if ($success)
        {
            $this->setData($data);
        }
    }
}

