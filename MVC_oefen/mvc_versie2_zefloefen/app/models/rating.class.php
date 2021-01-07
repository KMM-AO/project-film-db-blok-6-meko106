<?php

namespace app\models;

use core\Model;
use core\Database;
use PDO;

class Rating extends Model {

    /** de bijbehorende database-tabel */
    const TABLENAME = 'ratings';
    
    public function __construct()
    {
        /**
         * Roep de parent-constructor aan met ��n optionele parameter:
         * primary-key-definitie als een array met twee elementen [naam, pdo-paramtype]
         *   default is ['id', PDO::PARAM_INT]
         */
        parent::__construct();
    }

    /** setters */
    
    public function setId($value)
    {
        $this->setDataField('id', $value);
    }
    
    public function setIdUser($value)
    {
        $this->setDataField('id_user', $value);
    }
    
    public function setIdProduct($value)
    {
        $this->setDataField('id_product', $value);
    }
    
    public function setValue($value)
    {
        $this->setDataField('value', $value);
    }
    
    /** rating opslaan */
    
    public function save()
    {
        $this->validateValue();
        $this->validateIdProduct();
        
        if ($this->isValid())
        {
            if ($this->id !== null)
            {
                $this->update();
            }
            else
            {
                $this->insert();
            }
        }
    }
    
    private function validateValue()
    {   
        if ($this->value === null)
        {
            $this->setError('value', 'rating ontbreekt');
        }
        elseif (!preg_match('/^[1-5]$/', $this->value))
        {
            $this->setError('value', 'ongeldige waarde');
        }
    }
    
    private function validateIdProduct()
    {
        $product = new Product();
        $product->setId($this->id_product);
        $product->load($success);
        
        if (!$success)
        {
            $this->setError('id_product', 'product bestaat niet (meer)');
        }
    }
    
    /** DATABASE-methods */

    private function update()
    {
        $query = '
            UPDATE ratings
            SET value = :value, id_product = :id_product, id_user = :id_user
            WHERE id = :id  
        ';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $statement->bindValue(':id_product', $this->id_product, PDO::PARAM_INT);
        $statement->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);
        $statement->bindValue(':value', $this->value, PDO::PARAM_INT);
        
        $statement->execute();
    }
    
    private function insert()
    {
        $query = '
            INSERT INTO ratings (id_product, id_user, value)
            VALUES (:id_product, :id_user, :value)
        ';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id_product', $this->id_product, PDO::PARAM_INT);
        $statement->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);
        $statement->bindValue(':value', $this->value, PDO::PARAM_INT);
        
        $statement->execute();
        
        $this->setId($this->pdo->lastInsertId());        
    }
    
    /** static methods */
    
    static public function indexByUser($id_user) 
    {
        $pdo = Database::getInstance()->getPdo();
        
        $query = 
        '
            SELECT *
            FROM ratings
            WHERE id_user = :id_user
        ';
        
        $statement = $pdo->prepare($query);
        $statement->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $statement->execute();
        
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        
        foreach ($records as $record)
        {
            $object = new self();
            $object->setData($record);
            $objects[] = $object;
        }
        return $objects;
    }
}

