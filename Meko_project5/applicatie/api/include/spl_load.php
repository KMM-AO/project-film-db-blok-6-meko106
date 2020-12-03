<?php


spl_autoload_register("getClass");

function getClass($className){
    $path="../classes/";
    $fullPath=$path.$className.".class.php";
    include_once $fullPath;
    
}

?>