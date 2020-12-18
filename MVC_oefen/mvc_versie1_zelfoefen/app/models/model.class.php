<?php

use \core\Database;


abstract class Model{

    public $pdo;

    public function __construct(){
        $this->pdo=Database::getInstance()->getPdo();
    }
    
}





