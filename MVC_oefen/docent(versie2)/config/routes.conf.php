<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 * 
 * configuratiefile voor de toegestane routes
 */

$this->allowed_routes = 
[

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
];

