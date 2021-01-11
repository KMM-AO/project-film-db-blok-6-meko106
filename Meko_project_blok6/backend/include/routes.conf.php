<?php

use core\Route;


$this->routes = [

    new Route(
        'user/registerForm',
        'GET',
        'userController',
        'register_form'
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

    new Route(
        'indexFilms',
        'GET',
        'filmcontroller',
        'films_index'
    ),

    // new Route(

    // )


 
    

];

