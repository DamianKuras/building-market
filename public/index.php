<?php
require_once __DIR__.'/../vendor/autoload.php';
use app\base\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;
use app\controllers\AdminController;
use app\controllers\ProductController;
use app\models\User;

$config=[
    'userClass' => User::class,
];
$app = new Application(dirname(__DIR__),$config);


$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/products', [ProductController::class, 'products']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'contact']);

$app->router->post('/search-products',[ProductController::class,'searchProducts']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/product', [ProductController::class, 'showProductDetails']);
$app->router->get('/cart', [AuthController::class, 'cart']);
$app->router->post('/cart', [AuthController::class, 'cart']);

$app->router->post('/cart/remove', [AuthController::class, 'cartRemove']);
$app->router->post('/cart/add', [AuthController::class, 'cartAdd']);
$app->router->post('/cart/set-product-quantity',[AuthController::class, 'cartSetProductQuantity']);
$app->router->get('/shoping-history', [AuthController::class, 'shopingHistory']);

$app->router->get('/order', [AuthController::class, 'orderDetails']);

$app->router->get('/admin/all-order-list', [AdminController::class, 'allOrdersList']);
$app->router->get('/admin/order', [AdminController::class, 'orderDetails']);


$app->router->post('/admin/mark-as-sended', [AdminController::class, 'markAsSended']);

$app->router->get('/admin/edit-product', [AdminController::class, 'editProduct']);
$app->router->post('/admin/edit-product', [AdminController::class, 'editProduct']);
$app->router->post('/admin/remove-product', [AdminController::class, 'removeProduct']);

$app->router->get('/admin/add-product', [AdminController::class, 'addProduct']);
$app->router->post('/admin/add-product', [AdminController::class, 'addProduct']);

$app->router->get('/admin/get-products-list', [AdminController::class, 'getProductList']);

$app->run();
