<?php

class Film extends HF{

    public $person; //persons teble


    public function __construct(PDO $pdo){
        parent:: __construct($pdo);
    }

    public function getRegisseurId(){
        return $this->getFromData['id_regisseur'];
    }

    public function setId($value){
        $this->data['id']=$value;
    }

    public function getId(){
        return $this->data['id'];
    }

    public function getData(){
        return $this->data;
    }



    public function getRegisseur(){
        if(!isset($this->Regisseur)){
            $this->Regisseur=new Regisseur($this->pdo);
            $RegisseurId=$this->getRegisseurId();  // 
            $this->Regisseur->setReggiseurId($RegisseurId);
            $this->Regisseur->getFromDB();
        }
        return $this->Regisseur;
    }

    public function load(){
        $query='SELECT * FROM films WHERE id=:id '; // we give the id when making the films object
        $stmt=$this->pdo->prepare($query);
        $stmt->bindValue(':id', $this->getId(), PDO::PARAM_INT);
        $stmt->execute();
        $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->data=$records;
    }

    public function show_json(){
        $data= $this->getData();
        $data['regisseur']=$this->getRegisseur()->getData();
        return json_encode($data);
    }



}