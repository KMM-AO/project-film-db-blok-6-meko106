<?php

$this->allowed_routes = [

    /** testroutes */

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

    /** webrequests voor producten */ 
   
    new \core\Route( //uri= product/index
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
    ),
    
    new \core\Route(
        'product/rate/([1-9][0-9]*)',
        'POST',
        'ProductController',
        'rate'
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

    /** web-requests voor user-formulieren en -acties (authenticatie is geen request) */

    new \core\Route(
        'user/register',
        'GET',
        'UserController',
        'register_form'
    ),
    
    new \core\Route(
        'user/register',
        'POST',
        'UserController',
        'register'
    ),
    
    new \core\Route(
        'user/login',
        'GET',
        'UserController',
        'login_form'
    ),
    
    new \core\Route(
        'user/login',
        'POST',
        'UserController',
        'login'
    ),
    
    new \core\Route(
        'user/logout',
        'POST',
        'UserController',
        'logout'
    ),

    /** web-requests om user-acties na te bootsen: registratie, login, authenticatie, logout */
    
    new \core\Route(
        'api/user/register',
        'GET',
        'UserController',
        'register_form_api'
    ),
    
    new \core\Route(
        'api/user/login',
        'GET',
        'UserController',
        'login_form_api'
    ),
    
    new \core\Route(
        'api/user/authenticate',
        'GET',
        'UserController',
        'authenticate_form_api'
    ),
    
    new \core\Route(
        'api/user/logout',
        'GET',
        'UserController',
        'logout_form_api'
    ),

    /** api-requests voor user-acties: registratie, login, authenticatie, logout */
    
    new \core\Route(
        'api/user/register',
        'POST',
        'UserController',
        'register_api'
    ),
    
    new \core\Route(
        'api/user/login',
        'POST',
        'UserController',
        'login_api'
    ),
    
    new \core\Route(
        'api/user/authenticate',
        'POST',
        'UserController',
        'authenticate_api'
    ),
    
    new \core\Route(
        'api/user/logout',
        'POST',
        'UserController',
        'logout_api'
    )
];

