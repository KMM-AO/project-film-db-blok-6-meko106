<?php




function requireClass($class_name){ //replace \\ with / in $className
    $class_name = str_replace('\\', '/', $class_name);
    $class_file = '../' . strtolower($class_name) . '.class.php';
    // ../core/router.class.php
     
    if (!file_exists($class_file)){//if the file does not exist
        throw new Exception('Kan classfile ' . $class_file . ' niet openen.');
    }
    require $class_file;
}




spl_autoload_register('requireClass');

function myVarDump($var){ // var_dump function
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    echo '</hr>';
}
