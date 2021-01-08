<?php


class Database{


    private $pdo;

    private static $instance;


    private function __construct()
    {
        $dsn= 'mysql:host=localhost; dbname="films_db;" ';
        $this->pdo=new PDO($dsn,'noorderpoort', 'test');
    }


    private function __clone()
    {

    }


    public static function getInstance()
    {
        if(!isset(self::$instance))
        {
            self::$instance=new self();
        }
        return self::$instance;
    }


    public function getPdo(){
        return $this->pdo;
    }




}




