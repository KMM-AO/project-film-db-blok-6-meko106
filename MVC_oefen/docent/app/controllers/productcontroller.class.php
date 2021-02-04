<?php

namespace app\controllers;

use app\models\Product;

require('controller.class.php');

class ProductController extends Controller{
    // the controller adheres with the data

    // public $view
    public function index(){
        $this->view->setTemplate('product_index'); //*****VRAAAAG*****
        //$this->view->setTemplate=returs $this->template= 
        $this->view->add('producten', Product::index());//the index function of the Prododuct class
        $this->view->render(); // function render requires the
        // and extract the vars array
    }
    
    // public function show($id){
    //     $product = new Product();
    //     $product->setId($id);
    //     $product->load($ok);
    //     $this->view->setTemplate('product_show');
    //     $this->view->add('product', $product);
    //     $this->view->render();
    // }
}