<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 * 
 * index.php, de Single Point Of Entry
 */

require '../include/init.php';
\core\Router::getInstance()->go();


echo $_SERVER['REQUEST_URI'];

// the name of  the map (../core)

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<img src="img/1.png">
</body>
</html>