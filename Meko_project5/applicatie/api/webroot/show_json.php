<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf8');

include '../include/spl_load.php';

$pdo=new MyPDO();


$id=$_GET['id']??'';
$persondata=$_GET['persondata']??0;


$object=new Films($pdo);

if($id!==''){
    $arr=$object->getUsingId($id);
}else{
$arr=$object->showEveryThing();
}
echo json_encode($arr);


$id=$_GET['id'];
$product=new Prodcut();

$product->setId($id);
$product->load($succes); // load function select every thing from the 
// table prodrcut where the id is like the id of the object and sets the data
// of the record array  to the data property

if(!$succes){
    echo "404 not found";
}else{
    $json=$product->json_show();
    if(!$json){

    }
    else
    {
        echo $json;
    }
}









?>