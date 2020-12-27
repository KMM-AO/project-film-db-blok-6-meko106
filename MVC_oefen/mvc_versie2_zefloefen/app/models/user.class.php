<?php

namespace app\models;

class User extends Model {
    const TABLE_NAME= 'users';

    private $token;

    private $password;
    private $password_repeat;

    public function __construct(){
        parent:: __construct();
    }

    public function setId($value){
        $this->setDataField('id',$value);
    }

    public function setEmail($value){
        $this->setDataField('email', $value);
    }

    public function setName($value){
        $this->setDataField('name', $value);
    }

    public function setPasswordHash($value){
        $this->password=$value;
    }

    public function setPasswordRepeat($value){
        $this->password_repeat= $value;
    }

    public function setPassword($value){
        $this->password=$value;
    }


    public  function getToken(){
        if(!isset($this->token)){
            $this->token= new Token();
            $this->token->setIdUser($this->id);//the user id
            $this->token->loadByUser($succes);
        }
        return $this->token;
    }

    private function save(){
        $query=
        '
        INSERT INTO users (name, email, password_hash)
        VALUES (:name, :email, :password_hash)
        ';

        $stmt= $this->pdo->prepare($query);
        $stmt->bindValue(':name',$this->name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindValue('password_hash', $this->password_hash, PDO::PARAM_STR);
        $stmt->execute();

        $this->setId($this->pdo->lastInsertId() );
    }

    private function loadByEmail(&$succes){
        $query=
        '
        SELECT * 
        FROM users
        WHERE email= :email
        ';
        
        $stmt=$this->pdo->prepare($query);
        $stmt->bindValue(':email' , $this->email, PDO::PARAM_STR);
        $stmt->execute();
        $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $succes=($data != false);
        if($succes){
            $this->setData($data);
        }
    }
    
    public function login(){
        $this->loadByEmail($succes);
        
        if(!$succes){
            $this->setError('email', 'e-mailadres is niet geregistreerd');
        }elseif (!password_verify($this->password, $this->password_hash)){
            $this->setError('password', 'wachtwoord is onjuist');
        }
        
        if($this->isValid()){
            $this->getToken() -> regenerate();
        }
    }


    //registratie

    public function register(){
        $this->validateName();
        $this->validateEmail();
        $this->validatePassword();
        
        if($this->isValid() ){
            $this->setPasswordHash(password_hash($this->password, PASSWORD_DEFAULT));
            $this->save();

            $this->getToken();
        }
    }

    private function validateEmail(){
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $this->setError('email', 'emailadres is ongeldig');
        }else{
            $user=new User();
            $user->setEmail($this->email);
            $user->loadByEmail($succes);
            if($succes){
                $this->setError('email', 'emailadres is al geregistreerd');
            }
        }
    }

    public function validatePassword(){
        if(strlen($this->password) < 6 ){
            $this->setError('password', 'wachtwoord bevat minder dan 6 tekens');
        }elseif (!preg_match('/[A-Z]/', $this->password )) {
            $this->setError('password', 'wachtwoord bevat geen hoofdletter');
        }elseif(!preg_match('/[0-9]/', $this->password)){
            $this->setError('password', 'wachtwoord bevat geen cijfer');
        }elseif($this->password != $this->password_repeat){
            $this->setError('password_repeat', 'herhaalde wachtwoord is ongelijk aan eerste wachtwoord');
        }
    }





}
