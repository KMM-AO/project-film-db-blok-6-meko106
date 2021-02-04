<?php



class MyPDO extends PDO{
    
	public $host = 'localhost';
	public $db_naam = 'films_db';
	public $user  = 'noorderpoort';
	public $password = 'test';
    
	public function __construct() {
		$dsn ='mysql:host=' . $this->host.';dbname='.$this->db_naam;
		parent::__construct($dsn, $this->user, $this->password);
	}	
	
}

?>