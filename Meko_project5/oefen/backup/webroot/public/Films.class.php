<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf8');

include('PDO.class.php');




class Film{
    public $pdo;
    

    public function __construct(PDO $pdoObject){
        $this->pdo=$pdoObject;
    }


    public function getEveryThing(){

        $query='SELECT * FROM films';
        $stmt=$this->pdo->prepare($query);
        $stmt->execute();
        $record=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $record;
    }



    public function getEveryThingUsingTabel($tabel){
        $query='SELECT * FROM films 
        JOIN categorie ON films.categorie_fk=categorie.id 
        WHERE categorie.categorie=:categorie';
        $stmt=$this->pdo->prepare($query);
        $stmt->bindValue(':categorie',$tabel);
        $stmt->execute();
        $record=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $record;
    }


}



?>