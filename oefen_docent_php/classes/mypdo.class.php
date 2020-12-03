<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 */

class MyPDO extends PDO
{
    
    /** dit is niet de ideale vorm van configuratie */
	const DRIVER = 'mysql';
	const HOST = 'localhost';
	const PORT = '3306';
	const DBNAME = 'db_bier_versie2';
	const USERNAME  = 'noorderpoort';
	const PASSWORD = 'test';
    
	public function __construct() {
		$dsn = self::DRIVER . ':host=' . self::HOST . ';port='.self::PORT . ';dbname='.self::DBNAME;
		parent::__construct($dsn, self::USERNAME, self::PASSWORD);
		$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
}

// C:\xampp\htdocs\project_jaar2\oefen_docent\classes\Model.class.php
?>