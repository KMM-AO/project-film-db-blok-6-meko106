<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf8');

include('Films.class.php'); // it contains the myPDO class too


$categorie=$_GET['cat'];



$pdo=new MyPDO();

$film=new Film($pdo);


switch($categorie){
    case 'Films':
        $strJson=json_encode($film->getEveryThingUsingTabel('Films'));
    break;
    case 'TV Episodes':
        $strJson=json_encode($film->getEveryThingUsingTabel('TV_Episodes'));
    break;
    default:
    $strJson=json_encode($film->getEveryThing());
break;
}

echo $strJson;





?>