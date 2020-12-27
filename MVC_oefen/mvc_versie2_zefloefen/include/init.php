<?php


function addClass($className){
    $class=str_replace('\\','/',$className);
    $classFile='../'.strtolower($className).'.class.php';

    require $classFile;

}

spl_autoload_register('addClass');


?>



