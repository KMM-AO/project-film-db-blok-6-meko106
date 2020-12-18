<?php

namespace app\controllers;


class ProductController extends controller{
    public $view;

    public function index(){
        $this->view->setTemplate('product_index');
        $this->view->add('producten', Product::index() );
        $this->view->render();

    }

}









?>