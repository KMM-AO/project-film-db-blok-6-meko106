<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf8');

include '../include/spl_load.php';

$pdo=new MyPDO();


$categorie=$_GET['categorie']?? '';
$film_search_name=$_GET['name']?? '';
if($categorie!=='' && strlen($film_search_name)!==0 ){
    $categorie_object=new $categorie($pdo);
    $arr=$categorie_object->getUsingName(ltrim($film_search_name));
}
else
{
$filmId=$_GET['filmId'];
$acteurs=new Acteurs($pdo);
$arr=$acteurs->getActeursUsingFilmId($filmId);
}

echo json_encode($arr);
?>