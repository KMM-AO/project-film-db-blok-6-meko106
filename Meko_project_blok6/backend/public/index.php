<?php

use core\Router;

require '../include/init.php';

Router::getInstance()->go();

echo '<br>';

// echo dirname($_SERVER['SCRIPT_NAME']);

?>
