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
        $featured = $products->getAmount(3);
        return $this->render('home', [
            'featured' => $featured[0],
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
