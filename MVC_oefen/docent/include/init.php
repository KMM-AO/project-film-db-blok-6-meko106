<?php


function requireClass($class_name){ //replace \\ with / in $className
    $class_name = str_replace('\\', '/', $class_name); // if the \\ existes in the class
    $class_file = '../' . strtolower($class_name) . '.class.php';
    
    require $class_file;
    
}

spl_autoload_register('requireClass');




function myVarDump($var){ // var_dump function
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    echo '</hr>';
}
