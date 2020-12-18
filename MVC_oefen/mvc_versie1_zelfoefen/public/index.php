<?php

require '../include/init.php';

\core\Router::getInstance()->go();

$webroot=\core\Router::getInstance()->getWebroot();
// echo 'The webroot is '.$webroot;

// echo substr($_SERVER['REQUEST_URI'], strlen($webroot)) ;
// echo '<br>';
// echo '<br>';


// $uri=urldecode($_SERVER['REQUEST_URI']);

// echo $uri;

// echo '<br>';

// echo dirname($_SERVER['SCRIPT_NAME']);



?>


