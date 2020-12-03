<?php

class Films extends HF{

    public $person; //persons teble

    public function __construct(PDO $pdo){
        parent:: __construct($pdo);
    }

    public function setId($value){
        $this->data['id']=$value; // it is about the data of the film
    }
    
    public function getId(){
        return $this->getFromData('id'); 
    }

    public function getData(){
        return $this->data;
    }

    public function getRegisseurId(){
        return $this->getFromData('id_regisseur');
    }
    
    public function getRegisseur(){
        if(!isset($this->Regisseur)){
            $RegisseurId=$this->getRegisseurId(); 
            $this->Regisseur=new Regisseur($this->pdo);
            $this->Regisseur->setId($RegisseurId);
            $this->Regisseur->getFromDB();
        }
        return $this->Regisseur;
    }

    public function getActeurs(){
        if(!isset($this->Acteurs)){
            // $this->Acteurs=new Acteurs($this->pdo, $this->getId());
            // $Objects=[];
            // foreach ( $this->Acteurs->getFromDB() as $record){
            //     $Objects[]=$record;
            // }
            // return $Objects;
            $this->Acteurs=Acteurs::indexByFilm($this->pdo,$this->getId());
        }
        return $this->Acteurs;
    }
    
    public function load(){
        $query='SELECT * FROM films WHERE id=:id '; // we give the id when making the films object
        $stmt=$this->pdo->prepare($query);
        $stmt->bindValue(':id', $this->getId(), PDO::PARAM_INT);
        $stmt->execute();
        $records=$stmt->fetch(PDO::FETCH_ASSOC);
        $susses=$records!=false;
        if($susses){
        $this->setData($records);
        }else{
            echo "there were something went wrong";
        }
    }

    public function show_json(){
        $data= $this->getData();
        $data['regisseur']=$this->getRegisseur()->getData(); // here we add a new key to the array with name 'regisseur'
        // $data['acteurs']=$this->getActeurs();
        $data['acteurs']=[];

        foreach($this->getActeurs() as $acteur){
            $data['acteurs'][]=$acteur->getData();
        }
        return $data;
    }
}