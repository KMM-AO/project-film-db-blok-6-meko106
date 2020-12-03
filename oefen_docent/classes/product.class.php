<?php

class Product extends Model {
    /** relatie-properties */
    private $stijl;     // de 1-op-veel-relatie met stijlen, object van de class Stijl
    private $brouwer;   // de 1-op-veel-relatie met brouwers, object van de class Brouwer
    private $smaken;    // de veel-op-veel-relatie met smaken, array van objecten van de class Smaak
    const TABLENAME = 'producten';

    public function __construct(PDO $pdo){
        parent::__construct($pdo);
    }
    
    public function getId(){
        return $this->data['id'];
    }
    public function getNaam(){
        return $this->getDataField('naam');
    }
    public function getBeschrijving(){
        return $this->getDataField('beschrijving');
    }
    public function getIdStijl(){
        return $this->getDataField('id_stijl');
    }
    public function getIdBrouwer(){
        return $this->getDataField('id_brouwer');
    }
    public function setId($value){
        $this->data['id']= $value;
    }


    public function getStijl(){
        if (!isset($this->stijl)){
            $id_stijl = $this->getIdStijl();
            $this->stijl = new Stijl($this->pdo);
            $this->stijl->setId($id_stijl); 
            $this->stijl->load($success);
        }
        return $this->stijl;
    }
    
    public function getBrouwer(){
        if (!isset($this->brouwer)){
            $id_brouwer = $this->getIdBrouwer();
            $this->brouwer = new Brouwer($this->pdo);
            $this->brouwer->setId($id_brouwer);
            $this->brouwer->load($success);
        }
        return $this->brouwer;
    }
    
    public function getSmaken(){
        if (!isset($this->smaken)){
            $this->smaken = Smaak::indexByProduct($this->pdo, $this->getId());
        }
        return $this->smaken;
    }
    
    
    public function load(&$success){
        $query = 'SELECT * FROM producten WHERE id = :id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $this->getId(), PDO::PARAM_INT);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        $success = ($data != false); // $succes the fetch is not failure
        if ($success){ // if the fetch is not failure{
            $this->setData($data);  // product data is setted to $data(row/array)
        }
    }
    
    public function json_show(){
        $data = $this->getData(); // data is all set
        $data['stijl'] = $this->getStijl()->getData(); //getStijl is gets the
        //$this->stijl->
        $data['brouwer'] = $this->getBrouwer()->getData();
        $data['smaken'] = [];

        foreach ($this->getSmaken() as $smaak){
            $data['smaken'][] = $smaak->getData();
        }
        return json_encode($data);
    }
}
