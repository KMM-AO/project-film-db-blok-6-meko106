<?php

$this->allowed_routes = [
    new \core\Route(
        // new Route($request_url,$reqeust_method,$controller_class,$controller_method )
        'test', //request uri
        'GET', //controller method
        'TestController', //controller class
        'test' //controller method
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
        'product/index', //request uri
        'GET', //controller method
        'ProductController', //controller class
        'index' //controller method
    ),
    new \core\Route(
        'product/show/([1-9][0-9]*)',
        'GET',
        'ProductController',
        'show'
    )
];

