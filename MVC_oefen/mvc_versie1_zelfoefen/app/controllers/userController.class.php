<?php

namespace app\controllers;


class userController extends Controller{

    public function show($getal, $naam){
        $this->view->setTemplate('show');
        $this->view->add('number',$getal);
        $this->view->add('name', $naam);
        $this->view->render();
    }
}



?>