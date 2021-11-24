<?php
namespace app\controllers;
use app\base\Controller;
use app\base\exceptions\ProductNotFoundException;
use app\base\Request;
use app\base\Response;
use app\models\Product;

class ProductController extends Controller
{
    public function showProductDetails(Request $request)
    {

        $product =  new Product();
        $body = $request->getBody();
        if (!array_key_exists('id', $body)) {
            throw new ProductNotFoundException();
        }
        $productModel = $product->getById($body['id']);
        if ($productModel === false) {
            throw new ProductNotFoundException();
        }

        return $this->render('product', [
            'model' => $productModel
        ]);
    }

}