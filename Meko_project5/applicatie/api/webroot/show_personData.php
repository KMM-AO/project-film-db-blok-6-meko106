<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf8');

include '../include/spl_load.php';



$personData=$_GET['persondata'];

$pdo=new MyPDO();

if(is_numeric($personData)){
    $object=new Acteurs($pdo);
    $arr[]=$object->getUsingId($personData);

}else{
    $object=new Regisseurs($pdo);
    $object->getUsingName($personData);
    
    // $arr[0]=$personData." Is not numeric";
    $arr[]=$object->getUsingName($personData);

}

echo json_encode($arr);








?>