<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 */

namespace core;

use PDO;

/**
 * Database-class met singleton designpattern.
 * Deze class kan geen extensie van PDO zijn, omdat PDO een public constructor heeft,
 * en een singleton class een private constructor.
 * Het PDO-object is daarom een property van de Database class.
 */

 class Database{
    /**
     * static object van de class Database
     */
    private static $instance;
    
    /**
     * het pdo-object
     */
    private $pdo;

    /**
     * private constructor blokkeert het gebruik van new om Router-objecten te maken
     */
    private function __construct()
    {
        require '../config/database.conf.php';
		$dsn = $drvr . ':host=' . $host . ';port=' . $port . ';dbname=' . $name;
		$this->pdo = new PDO($dsn, $user, $pass);
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
    }

    /**
     * private clone-method
     */
    private function __clone()
    {
        // gebruiken we niet
    }
    
    /**
     * retourneert een object van de class Database zelf
     */
    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /** getter voor het PDO-object */
    public function getPdo()
    {
        return $this->pdo;
    }

}

?>