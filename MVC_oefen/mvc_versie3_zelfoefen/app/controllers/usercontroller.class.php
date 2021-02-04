<?php


namespace app\controllers;

use app\models\User;

class UserController extends Controller{


    public function register_form(){
     
        $this->session->add('referer', $_SERVER['HTTP_REFERER']);
        //here we add it to the session
        $this->view->setTemplate('user_register');
        $this->view->add('action', 'user/register');
        $this->view->add('errors', $this->session->getOnce('errors'));
        $this->view->add('post', $this->session->getOnce('post'));
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
            $this->session->add('message', 'Registratieformulier is niet goed ingevuld...');
            $this->session->add('errors', $user->getErrors());
            $this->session->add('post', array_diff_key($_POST, ['password' => '', 'password_repeat' => '']));
            
            $this->redirect('user/register');
        }else{
            $this->session->add('message', 'Dank voor de registratie...');
            $this->session->add('token', $user->getToken()->value);
            header('location: ' . $this->session->getOnce('referer'));
        }
    }
    


    

    public function login_form(){
        // BUG: alleen als de referer niet de loginactie (bij foute validatie) is
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