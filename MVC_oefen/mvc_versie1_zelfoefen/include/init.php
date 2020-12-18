<?php


function addClass($className){
    $class=str_replace('\\','/',$className);
    $classFile='../'.strtolower($className).'.class.php';

    include_once($classFile);

}

spl_autoload_register('addClass');



?>



