<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 */

namespace app\controllers;

use app\models\Product;
use app\models\Rating;

class ProductController extends Controller
{
    
    /**
     * Voorbeelden van de afhandeling van web-requests naar html-responses
     * 
     * Bij web-requests worden de producten als model-objecten beschikbaar gesteld
     * aan de View (en dus de template). 
     * Dat betekent dat je in de template nog gerelateerde gegevens kunt ophalen, zoals
     * de stijl, de brouwer en de smaken. 
     * 
     * Bij api-requests (zie onder) werkt dat anders.
     */
    
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
        $product->load($success);
        if (!$success)
        {
            $this->view->setTemplate('404');
        }
        else
        {
            $this->view->setTemplate('product_show');
            $this->view->add('product', $product);    
        }
        $this->view->render();
    }
    
    public function rate($id)
    {
        if (!$this->token->isValid())
        {
            $this->session->add('message', 'je bent niet ingelogd...');
        }
        else
        {
            $rating = $this->token->getUser()->getRatingByProduct($id);
            
            if (!isset($rating))
            {
                $rating = new Rating();
                $rating->setIdUser($this->token->getUser()->id);
                $rating->setIdProduct($id);
            }
            
            $rating->setValue($_POST['value'] ?? null);
            
            $rating->save();
            
            if (!$rating->isValid())
            {
                $this->session->add('message', join('; ', $rating->getErrors()));
            }
            else
            {
                $this->session->add('message', 'dank voor je rating...');
            }
            
            $this->redirect('product/show/' . $id);
            
        }
    }
    
    /**
     * Voorbeelden van de afhandeling van api-requests naar json-responses.
     * 
     * Anders dan bij web-requests, moet ALLE informatie die je nodig hebt op de client
     * meegestuurd worden in de json-response. 
     * Dus als je gerelateerde info nodig hebt (zoals stijl, brouwer, smaken), moet je die in
     * de controllermethod toevoegen aan de json-data.
     * 
     * Een alternatief is dat je je data vanuit de client ophaalt in stappen: bijvoorbeeld 
     * eerst de productgegevens en daarna voor elk product de benodigde gerelateerde gegevens,
     * maar dat is niet erg efficiënt
     */
    
    public function index_json()
    {
        $products = Product::index();
        $data = [];
        foreach ($products as $product)
        {
            $data[] = $product->GetData();
        }
        $this->json->add('producten', $data);
        $this->json->render();
    }
    
    public function show_json($id)
    {
        $product = new Product();
        $product->setId($id);
        $product->load($success);
        if (!$success)
        {
            $this->json->setStatus(404, 'Not Found');
        }
        else
        {
            $data = $product->getData();
            $data['stijl'] = $product->getStijl()->GetData();
            $data['brouwer'] = $product->getBrouwer()->GetData();
            $data['smaken'] = [];
            foreach ($product->getSmaken() as $smaak)
            {
                $data['smaken'][] = $smaak->getData();
            }
            $this->json->add('product', $data);
        }
        $this->json->render();
    }
}