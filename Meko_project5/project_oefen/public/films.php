<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf8');

include('PDO.class.php');





$pdo=new MyPDO();







function haalalles(PDO $pdo){

    $query='SELECT * FROM films';
    $stmt=$pdo->prepare($query);
    $stmt->execute();
    $record=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $record;
}

echo json_encode(haalalles($pdo));
?>