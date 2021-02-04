<?php

class Acteurs extends HF{

    protected $filmId;

    public function __construct(PDO $pdo){
        parent::__construct($pdo);
    }
    
    public function getFilmId(){
        return $this->filmId;
     }


    // public function getFromDB(){
    //     $query='SELECT persons.* FROM persons
    //     JOIN films_acteurs ON persons.id=films_acteurs.id_acteur
    //     JOIN films ON films.id=films_acteurs.id_film
    //     WHERE films.id=:film_id';
    //     $stmt=$this->pdo->prepare($query);
    //     $stmt->bindValue(':film_id',$this->getFilmId() );
    //     $stmt->execute();
    //     $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //     return $records;
    // }

    public function indexByFilm(PDO $pdo, $film_id){
        $query='SELECT persons.* FROM films_acteurs 
        JOIN persons ON persons.id=films_acteurs.id_acteur
        WHERE films_acteurs.id_film= :film_id
        ';
        $stmt=$pdo->prepare($query);
        $stmt->bindValue('film_id', $film_id);
        $stmt->execute();
        $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects=[];
        foreach($records as $record){
            $object=new self($pdo);
            $object->setData($record);
            $objects[]=$object;
        }
        return $objects;
    }





}


?>



