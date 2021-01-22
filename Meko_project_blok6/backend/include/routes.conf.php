<?php

use core\Route;


$this->routes = [

    new Route(
        'indexFilms',
        'GET',
        'filmcontroller',
        'films_index'
    ),
    new Route(
        'indexFilmsId/[1-50]',
        'GET',
        'filmcontroller',
        'filmsindexUsingId'
    ),

    new Route(
        'user/registerForm',
        'GET',
        'userController',
        'registerForm'
    ),

    new Route(
        'user/register',
        'POST',
        'userController',
        'register'
    ),

    new Route(
        'user/logInForm',
        'GET',
        'userController',
        'login_form'
    ),

    new Route(
    'user/login',
    'POST',
    'userController',
    'login'
    ),
    
];

