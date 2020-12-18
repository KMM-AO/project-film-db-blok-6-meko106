<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 */

namespace core; 
//you define a namespace as an name of an root/folder
//which you can use when you call a class
//the name space and then the class name


use PDO;    /** VRAAG */

class Database{
    private static $instance;
    
    /**
     * het pdo-object
     */
    private $pdo;

    /**
     * private constructor blokkeert het gebruik van new om Router-objecten te maken
     */
    private function __construct(){
        require '../config/database.conf.php';
		$dsn = $drvr . ':host=' . $host . ';port=' . $port . ';dbname=' . $name;
		$this->pdo = new PDO($dsn, $user, $pass);
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
    }



    private function __clone(){}


    public static function getInstance(){


        if (!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPdo(){
        return $this->pdo;
    }

}

?>