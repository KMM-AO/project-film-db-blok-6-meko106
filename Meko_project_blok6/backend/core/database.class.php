<?php


namespace core;
use PDO;



class Database{
    private static $instance;
    
    
    private $pdo;

    private function __construct(){
		$dsn = 'mysql:host=localhost; dbname=films_db';
		$this->pdo = new PDO($dsn, 'noorderpoort', 'test');
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
    }



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