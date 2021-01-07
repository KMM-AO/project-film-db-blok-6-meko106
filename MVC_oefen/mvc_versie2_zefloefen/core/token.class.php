<?php

namespace core;

use app\models\User;
use PDO;

class Token extends Model {
    
    /** de bijbehorende database-tabel */
    const TABLENAME = 'tokens';
    
    /** relatie-properties */
    private $user;              // token heeft 1-op-1-relatie met user
    
    public function __construct(){
        /**
         * Roep de parent-constructor aan met ��n optionele parameter:
         * primary-key-definitie als een array met twee elementen [naam, pdo-paramtype]
         *   default is ['id', PDO::PARAM_INT]
         */
        parent::__construct(['value', PDO::PARAM_STR]);
    }
    
    /** setters */
    
    public function setValue($value){
        $this->setDataField('value', $value);
    }
    
    public function setIdUser($value){
        $this->setDataField('id_user', $value);
    }

    /** 
     * relaties (relaties zijn lazy loaded)
     */    
    public function getUser(){
        if (!isset($this->user)){        
            $this->user = new User();
            $this->user->setId($this->id_user);
            $this->user->load($success);
        }
        return $this->user;
    }

    /** niet-generieke database-acties */
    
    private function save(){
        $query =
        '
            INSERT INTO tokens (value, id_user)
            VALUES (:value, :id_user)
        ';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':value', $this->value, PDO::PARAM_STR);
        $statement->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);
        $statement->execute();
    }

    public function loadByUser(&$success){
        $query = 
        '
            SELECT *
            FROM tokens
            WHERE id_user = :id_user
        ';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        $success = ($data != false);
        if ($success)
        {
            $this->setData($data);
        }
    }
        
    public function generate(){
        $this->setValue(uniqid());
        $this->save();
    }
    
    public function regenerate(){
        $this->delete($success);
        $this->generate();
    }
    
    
    public function authenticated(){
        $this->setValue($_POST['token'] ?? '');
          
        if ($this->value == ''){
            $this->setError('token', 'token ontbreekt');
        }else{
            $this->load($ok);
            
            if (!$ok){
                $this->setError('token', 'token is ongeldig');
            }
        }
        return $this->isValid();
    }
 
}
