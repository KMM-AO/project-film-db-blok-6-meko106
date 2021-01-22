<?php

namespace app\controllers;
use app\controllers\Controller;

use app\models\Films;
use core\Router;


class filmController extends Controller{


    public function films_index(){ // returns only json
        $this->json->setData(Films::index() );
        $this->json->render();

 
    }


    public function filmsindexUsingId(){ //geein
        $film=new Films();
        $arr=explode('/', $_SERVER['REQUEST_URI']);
        $film->setId(end($arr));

        $film->load($succes);
        print_r($film->getData());

    }











}