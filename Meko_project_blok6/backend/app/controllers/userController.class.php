<?php

namespace app\controllers;

use app\controllers\Controller;
use core\Router;
use core\User;

class UserController extends Controller{



    public function register_form(){
        $this->view->setTemplate('register_form');
        $this->view->render();
        
    }







    public function register(){
        $user=new User();

        $user->setName($_POST['name']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setPasswordRepeat($_POST['passwordRepeat']);

        $user->register();

        if(!$user->isValid()){
            
            session_start(); $_SESSION['msg']="email is not valid"; $_SESSION['error']=$user->getErrors();
            header("Location: ".Router::getInstance()->getWebroot().'user/registerForm');
        
        }else{
            header("Location: ".Router::getInstance()->getWebroot().'user/registerForm');

        }
    }
}