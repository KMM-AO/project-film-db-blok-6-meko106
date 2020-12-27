<?php

namespace core;

use PDO;


class Database{

    private static $instance;
    private $pdo;

    private function __construct(){
        // require '../config/database.config.php';
        $dsn='mysql:host=localhost; dbname=db_bier_versie2';
        $this->pdo=new PDO($dsn,'noorderpoort','test');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private function __clone(){}

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance=new self();
        }
        return self::$instance;
    }


    public function getPdo(){
        return $this->pdo;
    }





}









?>