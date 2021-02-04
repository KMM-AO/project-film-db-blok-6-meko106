<?php

class Brouwer extends Model {
    
    const TABLENAME = 'brouwers';

    public function __construct(PDO $pdo){
        parent::__construct($pdo);
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
        $query = '
            SELECT *
            FROM brouwers
            WHERE id = :id';
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
