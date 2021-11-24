<?php

namespace app\controllers;

use app\base\Application;
use app\base\Controller;
use app\models\ContactForm;
use app\base\Request;
use app\base\Response;
use app\models\Product;

class SiteController extends Controller
{
    public function home()
    {
        $products = new Product();
        $onSale = $products->getAmount(10);
        return $this->render('home', [
            'onSales' => $onSale[0],
        ]);
    }
    
    public function products()
    {
        $products = new Product();
        $productsModels = $products->getAll();
        return $this->render('products', [
            'products' =>  $productsModels,
        ]);
    }
    public function contact(Request $request, Response $response)
    {

        $contact = new ContactForm();

        if ($request->isPost()) {
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->send()) {
                Application::$app->session->setFlash('succes', 'Thank you for your message, we will answer soon');
                return $response->redirect('/contact');
            }
        }
        return $this->render('contact', [
            'model' => $contact,
        ]);
    }
}
