<?php


spl_autoload_register('getClasses');

function getClasses($className){
    $path='../classes/'.$className.'.class.php';
    require_once($path);
}



?>