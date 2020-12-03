<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 * 
 * configuratiefile voor de toegestane routes
 */

$this->allowed_routes = 
[
    new \core\Route(
        'test',
        'GET',
        'TestController',
        'test'
    ),
    
    new \core\Route(
        'bla/bla/bla',
        'GET',
        'TestController',
        'bla3'
    ),
    
    new \core\Route(
        'show/([1-9][0-9]*)/user/([a-z]{5})',
        'GET',
        'UserController',
        'show'
    ),
    
    new \core\Route(
        'product/index',
        'GET',
        'ProductController',
        'index'
    ),
    
    new \core\Route(
        'product/show/([1-9][0-9]*)',
        'GET',
        'ProductController',
        'show'
    )

];

