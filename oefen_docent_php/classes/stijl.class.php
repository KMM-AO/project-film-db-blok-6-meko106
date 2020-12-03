<?php

class Stijl extends Model {

    const TABLENAME = 'stijlen';

    // public $data;

    public function __construct(PDO $pdo){
        parent::__construct($pdo);
    }
    
    public function getId(){
        return $this->getDataField('id');
    }

    public function getNaam(){
        return $this->getDataField('naam');
    }

    public function getTekst(){
        return $this->getDataField('tekst');
    }
    
    public function setId($value){ 
        $this->setDataField('id', $value);
    }

    /** database-acties */
    
    /** deze method kan in principe ook generiek gemaakt worden (net als Model::delete()) */
    public function load(&$success){
        $query = 'SELECT * FROM stijlen
        WHERE id = :id';

        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $this->getId(), PDO::PARAM_INT);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        $success = ($data != false);
        if ($success){
            $this->setData($data);
            //so $this (stijl object -> data = $data)
            // every class has an property data
        }
    }
}
