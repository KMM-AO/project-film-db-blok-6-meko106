<?php 

namespace core;
use app\models\User;
use PDO; 

class Token extends Model{

    const TABLE_NAME='tokens';

    private $user;

    public function __construct(){
        parent:: __construct();
    }


    public function setValue($value){
        $this->setDataField('value', $value);
    }

    public function setIdUser($value){
        $this->setDataField('id_user', $value);
    }

    public function getUser(){
        if(!isset($this->user) ){
            $this->user=new User();
            $this->user->setId($this->id_user);
            $this->user->load($succes);
        }
        return $this->user;
    }

    private function save(){
        $query=
        '
        INSERT INTO tokens (value, id_user)
        VALUES (:value, :id_user)
        ';
        $stmt= $this->pdo->prepare($query);
        $stmt->bindValue(':value', $this->value, PDO::PARAM_STR);
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_STR);
        $stmt->execute();
    }
    


    public function loadByUser(){
        $query=
        '
        SELECT *
        FROM tokens
        WHERE id_user= :id_user 
        ';

        $stmt=$this->pdo->prepare($query);
        $stmt->bindValue('id_user', $this->id_user, PDO::PARAM_INT);
        $stmt->execute();
        $data= $stmt->fetchAll(PDO::FETCH_ASSOC);
        $succes= ($data != false);
        if($succes){
            $this->setData($data);
        }
    }

    public function generate(){
        $this->setValue(uniqid());
        $this->save();
    }

    public function regenerate(){
        $this->delete($succes);
        $this->generate();
    }


    public function authenticated(){
        $this->setValue($_POST['token'] ?? '');
        if($this->value == ''){
            $this->setError('token', 'token ontbreekt');
        }else{
            $this->load($ok);
            if(!$ok){
                $this->setError('token', 'token is ongeldig');
            }
        }
        return $this->isValid();
    }
    
}








?>