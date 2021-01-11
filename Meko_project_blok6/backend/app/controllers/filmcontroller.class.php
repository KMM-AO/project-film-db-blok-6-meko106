<?php

namespace app\controllers;
use app\controllers\Controller;

use app\models\Films;


class filmController extends Controller{


    public function films_index(){
        $this->view->setTemplate('filmsIndex');
        $this->view->add('films', Films::index() ) ; // $films
        $this->view->render();
    }



}