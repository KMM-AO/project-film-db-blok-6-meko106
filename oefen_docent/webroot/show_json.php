<?php


header('Content-Type: application/json');
require '../include/init.php';

$id = $_GET['id'] ?? 0;
$pdo=new MyPDO();
$product = new Product($pdo);


$product->setId($id); // here we set the id to the product object
$product->load($success); //$product->data=getFromproducten$id
//load get everything where the id of the object like $id

$json = $product->json_show();

echo $json;
