<?php


namespace app\controllers;

use app\models\User;

class UserController extends Controller
{
    
    /**
     * REGISTRATIE-REQUESTS
     * 
     * - formulier voor web
     * - formulier voor api (simulatie, in de praktijk niet hier)
     * - actie voor web
     * - actie voor api
     */
    
    /**
     * Registratie-formulier (2x)
     * - verstuurt name, email, password en password_repeat
     */

    public function register_form()
    {
        // BUG 1: alleen als de referer niet de registratie-actie (bij foute validatie) is
        // BUG 2: niet beschikbaar als registratiepagina de landingpagina is
        $this->session->add('referer', $_SERVER['HTTP_REFERER']);
        
        $this->view->setTemplate('user_register');
        $this->view->add('action', 'user/register');
        $this->view->add('errors', $this->session->getOnce('errors'));
        $this->view->add('post', $this->session->getOnce('post'));
        $this->view->render();
    }

    public function register_form_api()
    {
        $this->view->setTemplate('user_register');
        $this->view->add('action', 'api/user/register');
        $this->view->render();
    }
    
    /**
     * Registratie-actie (2x)
     * - maak user-object
     * - stop gegevens (name, email, password en password_repeat) uit POST in user-object
     * - probeer user te registreren
     * - bij mislukking (api): stop validatie-errors in de response
     * - bij succes (api): stop naam van de user en token in de response
     * - bij mislukking/succes (web): redirect met sessiedata
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
            $this->session->add('message', 'Registratieformulier is niet goed ingevuld...');
            $this->session->add('errors', $user->getErrors());
            $this->session->add('post', array_diff_key($_POST, ['password' => '', 'password_repeat' => '']));
            
            $this->redirect('user/register');
        }
        else
        {          
            $this->session->add('message', 'Dank voor de registratie...');
            $this->session->add('token', $user->getToken()->value);

            header('location: ' . $this->session->getOnce('referer'));
        }
    }
    
    public function register_api()
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
     * INLOG-REQUESTS
     * 
     * - formulier voor web
     * - formulier voor api (simulatie, in de praktijk niet hier)
     * - actie voor web
     * - actie voor api
     */
    
    /**
     * Inlog-formulier (2x)
     * - verstuurt email en password
     */

    public function login_form()
    {
        // BUG: alleen als de referer niet de loginactie (bij foute validatie) is
        $this->session->add('referer', $_SERVER['HTTP_REFERER']);
        
        $this->view->setTemplate('user_login');
        $this->view->add('action', 'user/login');
        $this->view->add('errors', $this->session->getOnce('errors'));
        $this->view->add('post', $this->session->getOnce('post'));
        $this->view->render();
    }

    public function login_form_api()
    {
        $this->view->setTemplate('user_login');
        $this->view->add('action', 'api/user/login');
        $this->view->render();
    }

    /**
     * Inlog-actie (2x)
     * - maak user-object
     * - stop gegevens (email, password) uit POST in user-object
     * - probeer user in te loggen
     * - bij mislukking (api): stop validatie-errors in de response
     * - bij succes (api): stop naam van de user en token in de response 
     * - bij mislukking/succes (web): redirect met sessiedata
     */

    public function login(){
        $user = new User();
        
        $user->setEmail($_POST['email'] ?? '');
        $user->setPassword($_POST['password'] ?? '');
        
        $user->login();
        
        if (!$user->isValid())
    {
            $this->session->add('message', 'Inloggegevens zijn niet correct...');
            $this->session->add('errors', $user->getErrors());
            $this->session->add('post', array_diff_key($_POST, ['password' => '']));
            
            $this->redirect('user/login');}
        else{
            $this->session->add('message', 'Je bent ingelogd...');
            $this->session->add('token', $user->getToken()->value);

            header('location: ' . $this->session->getOnce('referer'));
        }
    }

    public function login_api()
    {
        $user = new User();
        
        $user->setEmail($_POST['email'] ?? '');
        $user->setPassword($_POST['password'] ?? '');
        
        $user->login();
        
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
     * UITLOG-REQUESTS
     * 
     * - formulier voor api (simulatie, in de praktijk niet hier)
     * - actie voor web
     * - actie voor api
     * 
     * een formulier voor web ontbreekt, er zit een logoutbutton in de navigatie-include-template
     */

    /**
     * Logout-formulier (1x)
     * - verstuurt token
     */    
    public function logout_form_api()
    {
        $this->view->setTemplate('user_logout');
        $this->view->render();
    }
    
    /**
     * Logout-actie (2x)
     * Deze request is alleen zinvol als de user is geauthenticeerd (ingelogd)
     */

    public function logout(){        
        if (!$this->token->isValid()){
            $this->session->add('message', 'Je was niet (meer) ingelogd...');
        }else{         
            $this->token->delete($success);

            $this->session->add('message', 'Je bent uitgelogd...');
        }
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function logout_api()
    {        
        if (!$this->token->isValid())
        {
            $this->json->add('success', false);
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
    public function authenticate_form_api()
    {
        $this->view->setTemplate('user_authenticate');
        $this->view->render();
    }
   
    /**
     * Authenticatie-actie
     * 
     * Als user niet is geauthenticeerd:
     * - stop authenticatie-errors in de response (is niet erg relevant)
     * 
     * Als user wel is geauthenticeerd:
     * - stop de naam van de user in de response
     */
    public function authenticate_api()
    {
        if (!$this->token->isValid())
        {
            $this->json->add('success', false);
            $this->json->add('errors', $this->token->getErrors());  // onbelangrijk
        }
        else
        {
            $this->json->add('success', true);
            $this->json->add('user_name', $this->token->getUser()->name);
        }
        
        $this->json->render();    
    }
}