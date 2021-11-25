<?php

namespace app\controllers;

use app\base\Application;
use app\base\Controller;
use app\models\LoginForm;
use app\base\Request;
use app\base\Response;
use app\models\User;
use app\models\Cart;
use app\models\Product;
use app\models\Orders;
use app\models\OrderedItems;
use app\base\middlewares\AuthMiddleware;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->reigsterMiddleware(new AuthMiddleware(['profile', 'cart', 'cartRemove', 'cartAdd', 'shopingHistory']));
    }
    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                if(isset($_SESSION['rdrurl'])){
                    $response->redirect($_SESSION['rdrurl']);
                }
                else{
                    $response->redirect('/');
                }
                return;
            }
        }
        return $this->render('login', [
            'model' => $loginForm,
        ]);
    }
    public function register(Request $request)
    {
        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());
            if ($user->validate() && $user->save()) {
                Application::$app->session->setFlash('succes', 'Dziękujemy za rejestracje');
                if(isset($_SESSION['rdrurl'])){
                    $response->redirect($_SESSION['rdrurl']);
                }
                else{
                    $response->redirect('/');
                }
                exit;
            }

            return $this->render('register', [
                'model' => $user
            ]);
        }
        return $this->render('register', [
            'model' => $user
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        if(isset($_SESSION['rdrurl'])){
            $response->redirect($_SESSION['rdrurl']);
        }
        else{
            $response->redirect('/');
        }
    }

    public function cart(Request $request)
    {
        $cart = new Cart();
        $cartItems = $cart->getCardItems(Application::$app->user->id);
        if ($request->isPost()) {
            $order = new Orders();

            $order->user_id = Application::$app->user->id;
            $order->status = 0;
            $order->time = (new \DateTime())->format('Y-m-d H:i:s');
            $id = $order->saveWithId();
            foreach ($cartItems as $item) {
                $orderedItem = new OrderedItems();
                $orderedItem->order_id = $id;
                $orderedItem->ordered_product_id = $item['product_id'];
                $orderedItem->quantity = $item['quantity'];
                $orderedItem->save();
                $cart->removeFromCart(Application::$app->user->id,$item['product_id']);
            }

            Application::$app->session->setFlash('succes', 'Dziękujemy za zakup produktów');
            Application::$app->response->redirect('/');
            exit;
        }

        $orderedItemsModels = array();
        foreach ($cartItems as $item) {
            $product = new Product();
            $productDetails = $product->getById($item['product_id']);
            $displayModel = ['name' => $productDetails->name, 'brand' => $productDetails->brand, 'imageLink' => $productDetails->imageLink, 'quantity' => $item['quantity'], 'product_id' => $item['product_id']];
            $orderedItemsModels[] = $displayModel;
        }

        return $this->render('cart', [
            'cartItems' => $cartItems,
            'orderedItemsModels' => $orderedItemsModels
        ]);
    }
    public function cartRemove(Request $request, Response $response)
    {
        $cart = new Cart();
        $cart->loadData($request->getBody());
        $cart->removeFromCart(Application::$app->user->id, $cart->product_id);
        $response->redirect('/cart');
    }
    public function cartAdd(Request $request)
    {
        $cart = new Cart();
        $cart->loadData($request->getBody());
        $cart->user_id = Application::$app->user->id;
        $product = new Product;
        $productInfo = $product->getById($cart->product_id);
        if (!$productInfo->verifyQuantity($cart->quantity)) {
            return 'Sorry we dont have this many.';
        }
        if ($cart->itemAlreadyInCart(Application::$app->user->id, $cart->product_id)) {
            $cart->addQuantityToExisting(Application::$app->user->id, $cart->product_id, $cart->quantity);
            $productInfo->removeFromStock($cart->quantity);
            return 'Item already in cart. Added extra amount to cart';
        }
        if ($cart->validate() && $cart->save()) {
            $productInfo->removeFromStock($cart->quantity);
            return 'Succesfully added to cart';
        } else {
            return 'U need to sing up to add products to cart';
        }
    }
    public function carrSetProductQuantity(Request $request){
        
    }

    public function shopingHistory()
    {
        $order = new Orders();
        $ordersModels = $order->getAllWhere(['user_id' => Application::$app->user->id]);
        return $this->render('shopingHistory', [
            'ordersModels' => $ordersModels
        ]);
    }

    public function orderDetails(Request $request)
    {

        $order = new Orders();
        $order->loadData($request->getBody());

        $orderDetails = $order->findOne(['user_id' => Application::$app->user->id, 'id' => $order->id]);


        $orderedItems = new OrderedItems();
        $orderItems = $orderedItems->getAllWhere(['order_id' => $order->id]);

        $orderedItemsModels = array();
        foreach ($orderItems as $item) {
            $product = new product();
            $productDetails = $product->getById($item['ordered_product_id']);
            $displayModel = ['name' => $productDetails->name, 'brand' => $productDetails->brand, 'imageLink' => $productDetails->imageLink, 'quantity' => $item['quantity'], 'id' => $order->id];
            $orderedItemsModels[] = $displayModel;
        }

        return $this->render('Order', [
            'order' => $orderDetails,
            'orderedItemsModels' => $orderedItemsModels
        ]);
    }
}
