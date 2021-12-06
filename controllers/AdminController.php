<?php

namespace app\controllers;

use app\base\Application;
use app\base\Controller;
use app\base\middlewares\AdminAuthMiddleware;
use app\models\Orders;
use app\base\Request;
use app\models\OrderedItems;
use app\models\product;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->reigsterMiddleware(new AdminAuthMiddleware(['adminPanel', 'orderDetails', 'markAsSended', 'getProductList', 'editProduct', 'addProduct', 'removeProduct']));
    }

    public function allOrdersList()
    {
        $order = new Orders();
        $ordersModels = $order->getAll();
        return $this->render('Admin/AllOrdersList', [
            'order' => $order,
            'orders' => $ordersModels
        ]);
    }
    public function orderDetails(Request $request)
    {
        $order = new Orders();
        $order->loadData($request->getBody());
        $orderDetails = $order->findOne(['id' => $order->id]);
        $orderedItems = new OrderedItems();
        $orderItems = $orderedItems->getAllWhere(['order_id' => $order->id]);
        $orderedItemsModels = array();
        foreach ($orderItems as $item) {
            $product = new product();
            $productDetails = $product->getById($item['ordered_product_id']);
            $displayModel = ['name' => $productDetails->name, 'brand' => $productDetails->brand, 'imageLink' => $productDetails->imageLink, 'quantity' => $item['quantity'], 'id' => $order->id];
            $orderedItemsModels[] = $displayModel;
        }

        return $this->render('Admin/OrderDetails', [
            'order' => $orderDetails,
            'orderedItemsModels' => $orderedItemsModels
        ]);
    }
    public function markAsSended(Request $request)
    {
        $order = new Orders();
        $order->loadData($request->getBody());
        $order->markAsSended();
        Application::$app->session->setFlash('succes', 'Zmieniono status na wysłano');
        Application::$app->response->redirect('/Admin/all-orders-list');
        exit;
    }
    public function getProductList()
    {
        $products = new product();
        $productModels = $products->getAll();
        return $this->render('/Admin/AllProductList', [
            'productModels' => $productModels
        ]);
    }
    public function editProduct(Request $request)
    {
        $product = new Product();
        if ($request->isPost()) {
            $product->loadData($request->getBody());
            if ($product->validate() && $product->ProductUpdate()) {
                Application::$app->session->setFlash('succes', 'Pomyślnie zmieniono produkt');
                Application::$app->response->redirect('/admin/get-products-list');
                exit;
            }
            return $this->render('/Admin/EditProduct', [
                'model' => $product
            ]);
        }
        $product->loadData($request->getBody());
        $changed = $product->getById($product->id);
        return $this->render('/Admin/EditProduct', [
            'model' => $changed
        ]);
    }
    public function addProduct(Request $request)
    {

        $product = new Product();
        if ($request->isPost()) {
            $product->loadData($request->getBody());
            if ($product->validate() && $product->save()) {
                Application::$app->session->setFlash('succes', 'Pomyślnie dodano produkt');
                Application::$app->response->redirect('/Admin/getProductList');
                exit;
            }

            return $this->render('Admin/AddProduct', [
                'model' => $product
            ]);
        }
        return $this->render('Admin/AddProduct', [
            'model' => $product
        ]);
    }
    public function removeProduct(Request $request)
    {

        $product = new Product();
        $product->loadData($request->getBody());
        Product::remove(['id' => $product->id]);
        return true;
    }
}
