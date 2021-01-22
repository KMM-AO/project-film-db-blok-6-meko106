<?php

namespace app\models;

use core\Model;

class Films extends Model{

    const TABLENAME='films';
    
    public $persons;



    public function getRegisseurId(){
        return $this->getDataField('id_regisseur');
    }


    public function getRegisseur(){
        if(!isset($this->Regisseur)){
            $RegisseurId=$this->getRegisseurId();    
            $this->Regisseur=new Regisseur($this->pdo);
            $this->Regisseur->setId($RegisseurId);
            $this->Regisseur->getFromDB();
        }
    }
    
    
    public function getActeurs(){
        if(!isset($this->Acteurs)){
            $this->Acteurs=Acteurs::indexByFilm($this->getId());
        }
        return $this->Acteurs;
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