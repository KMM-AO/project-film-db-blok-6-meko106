<?php

namespace app\controllers;
use app\models\User;

class UserController extends Controller{

    public function register_form(){
        $this->view->setTemplate('user_register');
        $this->view->render();
    }

    public function login_form(){    // log in meth
        $this->view->setTemplate('user_login');
        $this->view->render();
    }

    public function logout_form(){
        $this->view->setTemplate('user_logout');
        $this->view->render();
    }

    public function authenticate_form(){
        $this->view->setTemplate('user_authenticate');
        $this->view->render();
    }


    public function register(){
        $user = new User();

        $user->setName(trim($_POST['name'] ?? ''));
        $user->setEmail(trim($_POST['email'] ?? ''));
        $user->setPassword(trim($_POST['password'] ?? ''));
        $user->setPasswordRepeat(trim($_POST['password_repeat'] ?? ''));
        
        $user->register();
        
        if (!$user->isValid()){
            $this->json->add('success', false);
            $this->json->add('errors', $user->getErrors());
        }else{
            $this->json->add('success', true);
            $this->json->add('user_name', $user->name);
            $this->json->add('token', $user->getToken()->value);
        }
        $this->json->render();
    }
    

    public function login(){ // when loggin in
        $user = new User();  // we make a new user
        $user->setEmail($_POST['email'] ?? '');
        $user->setPassword($_POST['password'] ?? '');
        
        $user->login();
        
        if (!$user->isValid()){
            $this->json->add('success', false);
            $this->json->add('errors', $user->getErrors());
        }else{
            $this->json->add('success', true);
            $this->json->add('user_name', $user->name);
            $this->json->add('token', $user->getToken()->value);
        }
        $this->json->render();
    }



    public function logout(){        
        if (!$this->token->authenticated()){
            $this->json->add('success', false);
            $this->json->add('errors', $this->token->getErrors());
        }else{
            $this->json->add('success', true);
            $this->json->add('user_name', $this->token->getUser()->name);
            $this->token->delete($success);
        }
        $this->json->render();    
    }


    public function authenticate(){
        if (!$this->token->authenticated()){
            $this->json->add('success', false);
            $this->json->add('errors', $this->token->getErrors());
        }else{
            $this->json->add('success', true);
            $this->json->add('user_name', $this->token->getUser()->name);
        }
        $this->json->render();    
    }
}