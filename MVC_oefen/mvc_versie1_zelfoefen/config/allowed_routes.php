<?php


$this->allowed_routes=[
    new \core\Route(
        'test',
        'GET',
        'TestController',
        'test'
    ),
    new \core\Route(
        'product/index',
        'GET',
        'produtcontroller',
        'index'
    ),
    new \core\Route(
        'zelfoefen',
        'GET',
        'testController',
        'test'
    )

    
]

?>