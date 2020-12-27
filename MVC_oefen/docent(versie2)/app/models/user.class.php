<?php

namespace app\models;

use core\Model;
use core\Token;
use PDO;

class User extends Model {
    
    /** de bijbehorende database-tabel */
    const TABLENAME = 'users';

    /** relatie-properties */
    private $token;             // user heeft 1-op-1-relatie met token
    
    /** password properties */
    private $password;
    private $password_repeat;
    
    public function __construct(){
        /**
         * Roep de parent-constructor aan met ��n optionele parameter:
         * primary-key-definitie als een array met twee elementen [naam, pdo-paramtype]
         *   default is ['id', PDO::PARAM_INT]
         */
        parent::__construct();
    }
    
    /** setters */
    
    public function setId($value){
        $this->setDataField('id', $value);
    }
    
    public function setEmail($value){
        $this->setDataField('email', $value);
    }
    
    public function setName($value){
        $this->setDataField('name', $value);
    }
    
    public function setPasswordHash($value){
        $this->setDataField('password_hash', $value);
    }
    
    public function setPassword($value){
        $this->password = $value;
    }
    
    public function setPasswordRepeat($value){
        $this->password_repeat = $value;
    }

    /** 
     * relaties
     * 
     * Relaties zijn in deze code lazy loaded,
     * d.w.z. ze worden pas uit de database opgehaald als ze opgevraagd worden.
     * 
     * Belangrijk is, dat relaties slechts 1x per request uit de database gehaald worden.
     * Dat wordt geregeld door de relatie op te slaan in een property. 
     * Als de property nog niet bestaat, wordt hij gemaakt en uit de database opgehaald.
     *  
    */
    
    public function getToken(){
        if (!isset($this->token)){

            $this->token = new Token();
            $this->token->setIdUser($this->id);
            $this->token->loadByUser($success);
        }
        return $this->token;
    }


    /** database-acties */

    private function save(){
        $query =
        '
            INSERT INTO users (name, email, password_hash)
            VALUES (:name, :email, :password_hash)
        ';

        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':name', $this->name, PDO::PARAM_STR);
        $statement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $statement->bindValue(':password_hash', $this->password_hash, PDO::PARAM_STR);
        $statement->execute();
        
        $this->setId($this->pdo->lastInsertId());
    }

    private function loadByEmail(&$success){
        $query = '
        SELECT *
        FROM users 
        WHERE email = :email
        
        ';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        $success = ($data != false);
        if ($success){
            $this->setData($data);
        }
    }
    
    /**
     * LOGIN
     */

    public function login(){
        $this->loadByEmail($success);
        
        if (!$success){
            $this->setError('email', 'e-mailadres is niet geregistreerd');
        }elseif (!password_verify($this->password, $this->password_hash)){
            $this->setError('password', 'wachtwoord is onjuist');
        }
                
        if ($this->isValid()){
            $this->getToken()->regenerate();
        }
    }

    /** REGISTRATIE */
    
    public function register(){
        $this->validateName();
        $this->validateEmail();
        $this->validatePassword();
        
        if ($this->isValid()){
            $this->setPasswordHash(password_hash($this->password, PASSWORD_DEFAULT));
            $this->save();
            /**
             * onderstaande code alleen gebruiken 
             * als je wil dat de user meteen ingelogd is na registratie
             */ 
            $this->getToken()->generate();
        }
    }
    
    /** name mag niet leeg zijn */
    private function validateName(){
        if ($this->name == ''){
            $this->setError('name', 'naam is leeg');
        }    
    }

    /** email moet voldoen aan de eisen voor een e-mailadres, en mag niet al geregistreerd zijn */
    private function validateEmail(){
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $this->setError('email', 'e-mailadres is ongeldig');
        }else{
            $user = new User();
            $user->setEmail($this->email);
            $user->loadByEmail($success);
            if ($success){
                $this->setError('email', 'e-mailadres is al geregistreerd');
            }
        }
    }
    
    /** password moet bestaan uit tenminste 6 tekens, waarvan tenminste 1 hoofdletter en tenminste 1 cijfer */
    private function validatePassword(){
        if (strlen($this->password) < 6){
            $this->setError('password', 'wachtwoord bevat minder dan 6 tekens');
        }elseif (!preg_match('/[A-Z]/', $this->password)){
            $this->setError('password', 'wachtwoord bevat geen hoofdletter');
        }elseif (!preg_match('/[0-9]/', $this->password)){
            $this->setError('password', 'wachtwoord bevat geen cijfer');
        }elseif ($this->password != $this->password_repeat){
            $this->setError('password_repeat', 'herhaalde wachtwoord is ongelijk aan eerste wachtwoord');
        }
    }
}
