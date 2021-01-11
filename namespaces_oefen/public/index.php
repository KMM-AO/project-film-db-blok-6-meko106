<?php


// use test\User;

// require_once 'User.php';

// $u=new User();

$pattern= '$webroot/index.php$';

preg_match($pattern,"#(webroot/index.php)(index)#",$matches);

print_r($matches);



