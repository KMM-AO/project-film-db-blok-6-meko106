<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 */

namespace app\controllers;

class UserController extends Controller{
    public function show($getal, $naam){
        $this->view->setTemplate('show');
        $this->view->add('number', $getal);
        $this->view->add('name', $naam);
        $this->view->render();
    }

    
}