<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 * 
 * initialisatiescript
 */

function requireClass($class_name)
{
    $class_name = str_replace('\\', '/', $class_name);
    $class_file = '../' . strtolower($class_name) . '.class.php';
    if (!file_exists($class_file))
    {
        throw new Exception('Kan classfile ' . $class_file . ' niet openen.');
    }
    require $class_file;
}

spl_autoload_register('requireClass');

function myVarDump($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    echo '</hr>';
}
