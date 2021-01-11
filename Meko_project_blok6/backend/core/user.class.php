<?php

namespace core;

use core\Model;
use core\Token;
use PDO;

class User extends Model {
    
    
    const TABLENAME = 'users';



    private $token;             
    private $ratings;       
    
    private $name;
    private $email;
    private $password;
    private $passwordRepeat;
    
    

    public function __construct(){
        parent::__construct();
    }

    public function setId($value){
        $this->setDataField('id',$value);
    }

    public function setName($value){
        $this->setDataField('name',$value);
    }

    public function setEmail($value){
        $this->setDataField('email',$email);
    }

    public function setPassword($value){
        $this->password=$value;
    }

    public function setPasswordRepeat($value){
        $this->passwordRepeat=$value;
    }

    
    public function register(){ //eerst de post input valideren
        $this->validateName(); 
        $this->validateEmail();
        $this->validatePassword();
        
        if ($this->isValid()){ // is valid if there are no error getErrors()==0
            $this->setPasswordHash(password_hash($this->password, PASSWORD_DEFAULT));
            $this->insert();

            $this->getToken()->generate();
        }
    }


    private function validateName(){
        if($this->getDataField('name') == '' ){
            $this->setError('name error','The name is empty');
        }
    }

    public function validateEmail(){
        $pattern='/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        $email=$this->getDataField('email');
        $validata=preg_match($pattern,$email);
        if($validata==0){
            $this->setError('email error', 'The email dos not match');
        }
    }
    
    private function validatePassword(){
        if (strlen($this->password) < 12){
            $this->setError('password', 'wachtwoord bevat minder dan 6 tekens');
        }
    }



}
