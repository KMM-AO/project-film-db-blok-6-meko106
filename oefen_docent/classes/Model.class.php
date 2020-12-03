<?php

abstract class Model {
    
    protected $pdo;         /** de databaseconnectie */
    private $data;          /** de associatieve array met record-gegevens van het object */
    //data is hier als property wat we willen ophalen
    
    public function __construct(PDO $pdo){
        $this->pdo = $pdo;  // making the pdo object
    }

    public function getData(){
        return $this->data; // $this->data is made by when laod() function  
    }

    protected function getDataField($name){ 
        return $this->data[$name] ?? NULL;
        //$this the object/class, after we set the data property, we can get the datafield
        //using getDataField, it returns the data[key] which we are looking for
    }

    protected function setData($value){ 
    // $this refers always to the class/object which is made/initilialize
        foreach ($value as &$str){
            $str = utf8_encode($str);
        }
        $this->data = $value;
    }
    
    protected function setDataField($name, $value){
        //$this objectclass, after the data is loaded, set the property/key to the value
        $this->data[$name] = $value;
    }


    public function json(){
        return json_encode($this->getData());
    }














    
    // static public function index(PDO $pdo) {
    //     $class = get_called_class();
    //     $query = 'SELECT * FROM '. $class::TABLENAME ;
    //     //the index method/function can be applied by every class/object
    //     //it selects everything from db(tbale name) which is provided by the class
    //     //self
    //     $statement = $pdo->prepare($query);
    //     $statement->execute();
    //     $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    //     //it returns an array, each row is an array
    //     $objects = [];
    //     foreach ($records as $record){
    //         //foreach row(as array) in the returned rowsarray
    //         $object = new $class($pdo); //making a new class object (product)
    //         $object->setData($record);//each object gets a row, and then setting
    //         $objects[] = $object; //the objects in an objects array
    //     }
    //     return $objects;
    // }//index() returns an array of objects from the class/name, each object contain an row from the db




    // static public function index_json(PDO $pdo) {
    //     $class = get_called_class();
    //     $objects = $class::index($pdo);
    //     $jsons = [];
    //     foreach ($objects as $object)
    //     {
    //         $json = $object->json();
    //         if (!$json)
    //         {
    //             /**
    //              * Blijkbaar was er een json-encoding-probleem met dit object.
    //              * Je zou hem over kunnen slaan (dus op deze plek niks doen).
    //              * Je kunt er ook voor kiezen om de id van het probleemgeval op te slaan in 
    //              * een array en die toe te voegen aan de paramlijst van de method (&$errors).
    //              */
    //         }
    //         else
    //         {
    //             /**
    //              * Blijkbaar geen json-encoding-probleem.
    //              * Dus gewoon toevoegen aan de te retourneren array.
    //              */
    //             $jsons[] = $json;
    //         }
    //     }
    //     return '[' . join(', ', $jsons) . ']';
    // }
}