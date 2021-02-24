<?php

namespace app\models;

use core\Model;
use core\Database;
use PDO;

class Acteurs extends Model{

    protected $filmId;

    public function __construct(){
        parent::__construct();
        
    }
    
    public function getFilmId(){
        return $this->filmId;
     }
     
     
     
     public function indexByFilm ($film_id){
         // select from persons based on the filmId
        $query='SELECT persons.* FROM films_acteurs 
        JOIN persons ON persons.id=films_acteurs.id_acteur
        WHERE films_acteurs.id_film= :film_id
        ';
        $pdo=Database::getInstance()->getPdo();
        $stmt=$pdo->prepare($query);
        $stmt->bindValue('film_id', $film_id);
        $stmt->execute();
        $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects=[];
        // foreach($records as $record){
        //     $object=new self();
        //     $object->setData($record);
        //     $objects[]=$object;
        // }
        return $records;
    }





}


?>



