<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf8');

class MyPDO extends PDO
{
    
    /** dit is niet de ideale vorm van configuratie */
	const DRIVER = 'mysql';
	const HOST = 'localhost';
	const PORT = '3306';
	const DBNAME = 'films_db';
	const USERNAME  = 'noorderpoort';
	const PASSWORD = 'test';
    
	public function __construct() {
		$dsn = self::DRIVER . ':host=' . self::HOST.';dbname='.self::DBNAME;
		parent::__construct($dsn, self::USERNAME, self::PASSWORD);
		$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
}

?>