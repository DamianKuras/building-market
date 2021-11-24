<?php
require_once __DIR__.'/../vendor/autoload.php';
use app\base\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;
use app\controllers\AdminController;
use app\controllers\ProductController;
use app\models\User;


$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$config=[
    'userClass' => User::class,
    'db'=>[
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];
$app = new Application(dirname(__DIR__), $config);


$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/products', [SiteController::class, 'products']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'contact']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/product', [ProductController::class, 'showProductDetails']);
$app->router->get('/cart', [AuthController::class, 'cart']);
$app->router->post('/cart', [AuthController::class, 'cart']);

$app->router->get('/cart/remove', [AuthController::class, 'cartRemove']);
$app->router->get('/cart/add', [AuthController::class, 'cartAdd']);
$app->router->get('/shopingHistory', [AuthController::class, 'shopingHistory']);

$app->router->get('/order', [AuthController::class, 'orderDetails']);

$app->router->get('/admin', [AdminController::class, 'adminPanel']);
$app->router->get('/admin/order', [AdminController::class, 'orderDetails']);


$app->router->get('/admin/markAsSended', [AdminController::class, 'markAsSended']);

$app->router->get('/admin/editProduct', [AdminController::class, 'editProduct']);
$app->router->post('/admin/editProduct', [AdminController::class, 'editProduct']);
$app->router->get('/admin/removeProduct', [AdminController::class, 'removeProduct']);

$app->router->get('/admin/addProduct', [AdminController::class, 'addProduct']);
$app->router->post('/admin/addProduct', [AdminController::class, 'addProduct']);

$app->router->get('/admin/getProductList', [AdminController::class, 'getProductList']);

$app->run();
