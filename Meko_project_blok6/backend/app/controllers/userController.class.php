<?php

namespace app\controllers;

// require '../include/init.php';


use app\controllers\Controller;
use core\Router;
use app\models\User;

class UserController extends Controller{


    public function registerForm(){
        $this->session->addToSession('referer', $_SERVER['HTTP_REFERER']);
        // echo $_SERVER['HTTP_REFERER '];

        $this->view->setTemplate('user_register');
        $this->view->add('_message', "bdkfjdskfj");
        $this->view->render();
    }
    
    
    public function register(){
        $user=new User();
        $user->setName($_POST['name']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['pass']);
        $user->setPasswordRepeat($_POST['rpass']);
        // print_r($_POST
        // $user->register($succes);
        $user->register();
        if($user->isValid()){ // if there are no errors in the user class
            $this->session->addToSession('msg','registering is goodlucked');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }else{
            $this->session->addToSession('errors', $user->getErrors());
        }
    }

    public function register_api(){
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



    public function login_form(){

        $this->session->add('referer', $_SERVER['HTTP_REFERER']);

        $this->view->setTemplate('user_login');
        $this->view->add('action', 'user/login');
        $this->view->add('errors', $this->session->getOnce('errors'));
        $this->view->add('post', $this->session->getOnce('post'));
        $this->view->render();
    }

    public function login_form_api(){
        $this->view->setTemplate('user_login');
        $this->view->add('action', 'api/user/login');
        $this->view->render();
    }



    public function login(){
        $user = new User();
        
        $user->setEmail($_POST['email'] ?? '');
        $user->setPassword($_POST['password'] ?? '');
        
        $user->login();
        
        if (!$user->isValid()){
            $this->session->add('message', 'Inloggegevens zijn niet correct...');
            $this->session->add('errors', $user->getErrors());
            $this->session->add('post', array_diff_key($_POST, ['password' => '']));
            
            $this->redirect('user/login');
        }else{
            $this->session->add('message', 'Je bent ingelogd...');
            $this->session->add('token', $user->getToken()->value);

            header('location: ' . $this->session->getOnce('referer'));
        }
    }

    public function login_api(){
        $user = new User();
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


    public function logout_form_api(){
        $this->view->setTemplate('user_logout');
        $this->view->render();
    }


    public function logout(){        
        if (!$this->token->isValid()){
            $this->session->add('message', 'Je was niet (meer) ingelogd...');
        }else{         
            $this->token->delete($success);

            $this->session->add('message', 'Je bent uitgelogd...');
        }
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function logout_api(){        
        if (!$this->token->isValid()){
            $this->json->add('success', false);
        }else{
            $this->json->add('success', true);
            $this->json->add('user_name', $this->token->getUser()->name);
            $this->token->delete($success);
        }
        $this->json->render();    
    }
    
    /**
     * AUTHENTICATIE-REQUESTS
     * 
     * - formulier voor api (simulatie, in de praktijk niet hier)
     * - actie voor api
     * 
     * formulier en actie voor web ontbreken, die zijn niet nodig als requests
     */

    /**
     * Authenticatieformulier.
     * - verstuurt token
     */
    public function authenticate_form_api(){
        $this->view->setTemplate('user_authenticate');
        $this->view->render();
    }

    public function authenticate_api(){
        if (!$this->token->isValid()){
            $this->json->add('success', false);
            $this->json->add('errors', $this->token->getErrors());  // onbelangrijk
        }else{
            $this->json->add('success', true);
            $this->json->add('user_name', $this->token->getUser()->name);
        }
        $this->json->render();    
    }













}