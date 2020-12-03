<?php

$this->allowed_routes=
[
    new Route(
        'index',
        'GET',
        'TestController',
        'index'
    ),

    new Route(
        'show/[1-9][0-9]*',
        'GET',
        'TestController',
        'show'

    )
    
];





?>