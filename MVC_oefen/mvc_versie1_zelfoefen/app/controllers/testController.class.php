<?php

namespace app\controllers;



class testController extends controller { 

    public function test(){
        $this->view->setTemplate('zelftest');
        $this->view->render();
    }
}

?>