<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 */

namespace app\controllers;

use app\models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $this->view->setTemplate('product_index');
        $this->view->add('producten', Product::index());
        $this->view->render();
    }
    
    public function show($id)
    {
        $product = new Product();
        $product->setId($id);
        $product->load($ok);
        $this->view->setTemplate('product_show');
        $this->view->add('product', $product);
        $this->view->render();
    }
}