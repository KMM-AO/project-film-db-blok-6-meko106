<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 * 
 * index.php, de Single Point Of Entry
 */

require '../include/init.php';
\core\Router::getInstance()->go();
