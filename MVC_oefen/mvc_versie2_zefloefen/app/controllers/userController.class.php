<?php

namespace app\controllers;
use app\models\User;

class UserController extends Controller{
    
    /**
     * TEST-methods voor het nabootsen van api-requests. 
     */
    
    /**
     * Registratieformulier.
     * 
     * - doet POST-request naar api/user/register
     * - verstuurt name, email, password en password_repeat
     */
    public function register_form()
    {
        $this->view->setTemplate('user_register');
        $this->view->render();
    }
    
    /**
     * Loginformulier.
     * 
     * - doet POST-request naar api/user/login
     * - verstuurt email en password
     */
    public function login_form()
    {
        $this->view->setTemplate('user_login');
        $this->view->render();
    }

    /**
     * Logoutformulier.
     * 
     * - doet POST-request naar api/user/logout
     * - verstuurt token
     */    
    public function logout_form()
    {
        $this->view->setTemplate('user_logout');
        $this->view->render();
    }
    
    /**
     * Authenticatieformulier.
     * 
     * - doet POST-request naar api/user/authenticate
     * - verstuurt token
     */
    public function authenticate_form()
    {
        $this->view->setTemplate('user_authenticate');
        $this->view->render();
    }

    /**
     * API-requests
     */
     
    /**
     * Registratie-request
     * 
     * - maak user-object
     * - stop gegevens (name, email, password en password_repeat) uit POST in user-object
     * - probeer user te registreren
     * - bij mislukking: stop validatie-errors in de response
     * - bij succes: stop naam van de user en token in de response 
     */
    public function register()
    {
        $user = new User();
        
        $user->setName(trim($_POST['name'] ?? ''));
        $user->setEmail(trim($_POST['email'] ?? ''));
        $user->setPassword(trim($_POST['password'] ?? ''));
        $user->setPasswordRepeat(trim($_POST['password_repeat'] ?? ''));
        
        $user->register();
        
        if (!$user->isValid())
        {
            $this->json->add('success', false);
            $this->json->add('errors', $user->getErrors());
        }
        else
        {
            $this->json->add('success', true);
            $this->json->add('user_name', $user->name);
            $this->json->add('token', $user->getToken()->value);
        }
        
        $this->json->render();
    }
    
    /**
     * Login-request
     * 
     * - maak user-object
     * - stop gegevens (email, password) uit POST in user-object
     * - probeer user in te loggen
     * - bij mislukking: stop validatie-errors in de response
     * - bij succes: stop naam van de user en token in de response 
     */
    public function login(){
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

    /**
     * Logout-request
     * Deze request is alleen toegestaan als de user is geauthenticeerd (ingelogd)
     * 
     * Als user niet is geauthenticeerd:
     * - stop authenticatie-errors in de response
     * 
     * Als user wel is geauthenticeerd:
     * - stop de naam van de user in de response
     * - verwijder het token
     */
    public function logout()
    {        
        if (!$this->token->authenticated())
        {
            $this->json->add('success', false);
            $this->json->add('errors', $this->token->getErrors());
        }
        else
        {
            $this->json->add('success', true);
            $this->json->add('user_name', $this->token->getUser()->name);
            
            $this->token->delete($success);
        }
        
        $this->json->render();    
    }
    
    /**
     * Authenticatie-request
     * 
     * Als user niet is geauthenticeerd:
     * - stop authenticatie-errors in de response
     * 
     * Als user wel is geauthenticeerd:
     * - stop de naam van de user in de response
     */
    public function authenticate()
    {
        if (!$this->token->authenticated())
        {
            $this->json->add('success', false);
            $this->json->add('errors', $this->token->getErrors());
        }
        else
        {
            $this->json->add('success', true);
            $this->json->add('user_name', $this->token->getUser()->name);
        }
        
        $this->json->render();    
    }
}