<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf8');

include '../include/spl_load.php';
$pdo=new MyPDO();

$id=$_GET['id'];

$film=new Films($pdo);
$film->setId($id);

$film->load();

$json=$film->show_json();

echo json_encode($json);

?>