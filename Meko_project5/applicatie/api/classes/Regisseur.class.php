<?php


class Regisseur extends HF{

    //public $data;
    //getFrom 

    public function __construct($pdo){
        parent:: __construct($pdo);
    }

    public function setReggiseurId($id){
        $this->id=$id;
    }

    public function getId(){
        return $this->id;
    }


    public function getFromDB(){
        $query=
        '
        SELECT * FROM persons 
        WHERE id=:id
        ';
        $stmt=$this->pdo->prepare($query);
        $stmt->bindValue(':id', $this->getId(), PDO::PARAM_INT );
        $stmt->execute();
        $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $succes=($records!=false);
        if($succes){
            $this->data=$records;
        }
    }



}