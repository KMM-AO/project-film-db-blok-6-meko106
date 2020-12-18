<?php

require '../include/init.php';

\core\Router::getInstance()->go();

echo $_SERVER['REQUEST_URI'];




?>
