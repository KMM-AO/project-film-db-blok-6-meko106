<?php

namespace app\controllers;
use app\controllers\Controller;

use app\models\Films;
use core\Router;

require 'controller.class.php';

class filmController extends Controller{


    public function films_index(){ // returns only jso
        $data=[];
        $films=Films::index();

        foreach($films as $film){
            $data[]=$film->getData();
        }
        $this->json->add( 'films', $data);
        $this->json->render();
    }


    public function FilmShow(){ //geein

        $product = new Films();
        $UriString=explode('/' , $_SERVER['REQUEST_URI']); 
        $id=$UriString[sizeof($UriString)-1 ] ; 
        
        $product->setId($id);
        $product->load($success);
        if (!$success)
        {
            // $this->view->setTemplate('404');
        }
        else
        {
            $this->json->add('film', $product->getData());   
        }
        $this->json->render();
    }


}