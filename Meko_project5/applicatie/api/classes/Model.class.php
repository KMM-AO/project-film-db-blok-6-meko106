<?php


abstract class Model{

    public $pdo; 

    public $data; //

    public $primary_type;
    public $primary_name;


    public function __construct(PDO $pdo, $primary_def=['id',PDO::PARAM_INT] ){
        $this->pdo=$pdo;
        $this->setPrimaryName($primary_def[0]);
        $this->setPrimaryType($primary[1]);
    }

    public function setPrimaryName($value){
        $this->primary_name=$value;
    }

    public function setPrimaryType($value){
        $this->primary_type=$value;
    }

    public function getPrimaryName(){
        return $this->primary_name;
    }

    public function getPrimaryType(){
        return $this->primary_type;
    }

    public function getData(){
        return $this->data;
    }

    public function getdataField($name){
        return $this->data[$name]?? NULL;
    }

    public function setDataField($name,$value){
        $this->data[$name]=$value;
    }

    public function setData($value){
        foreach($value as &$str){
            $str=utf8_decode($str);
        }
        $this->data=$value;
    }

    public function index(PDO $pdo){
        $class=get_called_class();
        $query='SELCT * FROM '.$class::TABLENAME;
        $stmt=$pdo->prepare($query);
        $stmt->execute();

        $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects=[];
        foreach($records as $record){
            $object=new $class($pdo);
            $object->setData($record);
            $objects[]=$object;
        }
        return $objects;
    }

    public function json(){
        return json_encode($this->getData());
    }

    static public function index_json(PDO $pdoclass){
        $class=get_called_class();

        $objects=$class::index();
        $jsons=[];
        foreach($objects as $object){
            $json=$object->json();
            if(!$json){


            }else{
                $jsons[]=$json;
            }
            return '['.join(', ',$jsons).']';
        }
    }






}


?>