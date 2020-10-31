<?php




class MyPDO extends PDO {
	const DRIVER = 'mysql';
    	const HOST = '127.0.0.1';
    	const PORT = '3306';
    	const DBNAME = 'klanten_erd';
    	const USERNAME  = 'noorderpoort';
    	const PASSWORD = 'test';

	public function __construct() {
		$dsn = self::DRIVER . ':host=' . self::HOST . ';port='.self::PORT . ';dbname='.self::DBNAME;
		parent::__construct($dsn, self::USERNAME, self::PASSWORD);
		$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
}


class Model{
	public $pdo;
    public function __construct($pdo){
        $this->pdo;
	}
	
	public function load(){
		$pdo=new MyPDO();
		$quer="SELECT * FROM klanten";
		$stmt=$pdo->prepare($quer);
		$stmt->execute();
		$record=$stmt->fetchAll(PDO::FETCH_ASSOC);
		print_r($record[0]);
	}
}


// $id=$_GET['id'];
$pdo=new MyPDO();
$car= new Model($pdo);


if(isset($_SESSION['input'])){
    $car->make($_SESSION['input']);
    unset($_SESSION['input']);
}else{
    $car->load();
}



?>