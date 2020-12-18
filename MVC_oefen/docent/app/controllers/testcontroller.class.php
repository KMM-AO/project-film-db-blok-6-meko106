<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 */

namespace app\controllers;

class TestController extends Controller{

    public function test(){
        $this->view->setTemplate('test');
        $this->view->render();
    }
    
    public function bla3(){
        $this->view->setTemplate('bla3');
        $this->view->render();
    }
}