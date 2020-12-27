<?php


$this->allowed_routes=[
    new \core\Route(
        'test',
        'GET',
        'testController',
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
    ),
    new \core\Route(
        'product/show/([1-9][0-9]*)',
        'GET',
        'ProductController',
        'show'
    ),
    
    /** api-requests voor producten */
    
    new \core\Route(
        'api/product/index',
        'GET',
        'ProductController',
        'index_json'
    ),

    new \core\Route(
        'api/product/show/([1-9][0-9]*)',
        'GET',
        'ProductController',
        'show_json'
    ),

    /** web-request om user-acties na te bootsen: registratie, login, authenticatie, logout */
    
    new \core\Route(
        'user/register',
        'GET',
        'UserController',
        'register_form'
    ),
    
    new \core\Route(
        'user/login',
        'GET',
        'UserController',
        'login_form'
    ),
    
    new \core\Route(
        'user/authenticate',
        'GET',
        'UserController',
        'authenticate_form'
    ),

    
    new \core\Route(
        'user/logout',
        'GET',
        'UserController',
        'logout_form'
    ),

    /** api-requests voor user-acties: registratie, login, authenticatie, logout */
    
    new \core\Route(
        'api/user/register',
        'POST',
        'UserController',
        'register'
    ),
    
    new \core\Route(
        'api/user/login',
        'POST',
        'UserController',
        'login'
    ),
    
    new \core\Route(
        'api/user/authenticate',
        'POST',
        'UserController',
        'authenticate'
    ),
    
    new \core\Route(
        'api/user/logout',
        'POST',
        'UserController',
        'logout'
    )
]
?>