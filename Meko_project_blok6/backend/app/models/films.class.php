<?php

namespace app\models;

use core\Model;

class Films extends Model{

    const TABLENAME='films';

    // public $persons;



    // public function getRegisseurId(){
    //     return $this->getDataField('id_regisseur');
    // }

    public function setId($value)
    {
        $this->setDataField('id', $value);
    }


    // public function getRegisseur(){
    //     if(!isset($this->Regisseur)){
    //         $RegisseurId=$this->getRegisseurId();    
    //         $this->Regisseur=new Regisseur($this->pdo);
    //         $this->Regisseur->setId($RegisseurId);
    //         $this->Regisseur->getFromDB();
    //     }
    // }
    
    
    // public function getActeurs(){
    //     if(!isset($this->Acteurs)){
    //         $this->Acteurs=Acteurs::indexByFilm($this->getId());
    //     }
    //     return $this->Acteurs;
    // }



  





}