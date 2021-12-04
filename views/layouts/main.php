<?php

use app\base\Application;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Damian Kuraś">
    <link rel="stylesheet" href="/css/style.css">
    <title><?php echo $this->title ?></title>
    <script src="https://kit.fontawesome.com/e4e6c7b251.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="/assets/favicon.ico">
</head>

<body class="d-flex flex-column min-vh-100">


    <header class="p-1 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="/assets/logo.png" alt="image">
                </a>
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li>
                        <a href="/products" class="nav-link px-2 text-white">Products</a>
                    </li>
                    <li>
                        <a class="nav-link px-2 text-white" href="/contact">Contact</a>
                    </li>
                </ul>


                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" action="/searchProducts" method="POST">
                    <div class="input-group">
                        <input type="search" name="searchText" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>

                </form>
                <div class="text-end">
                    <!-- {{login}} -->
                    <?php if (Application::isGuest()) : ?>
                        <a class="btn btn-outline-light me-2" href='/login'>Sing-in</a>
                        <a class="btn btn-warning" href='/register'>Sign-up</a>
                    <?php elseif (Application::isAdmin()) : ?>
                        <a class="btn btn-outline-light me-2" href="/admin">Lista Zamówień</a>
                        <a class="btn btn-outline-light me-2" href="/admin/getProductList">All products list</a>
                        <a class="btn btn-outline-light me-2" href="/admin/addProduct">Add Products</a>
                        <a class="btn btn-outline-light me-2" href="/logout">Logout</a>
                    <?php elseif (Application::isUser()) : ?>
                        <div class="d-flex p-2">
                            <a class="btn btn-outline-light me-2" href="/cart">Cart</a>
                            <div class="dropdown">
                                <a href="#" class="btn btn-outline-light text-decoration-none dropdown-toggle me-2" id="dropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i>
                                </a>
                                <ul class="dropdown-menu text-small" aria-labelledby="dropdown1" style="">
                                    <li><a class="dropdown-item" href="/shopingHistory">Orders</a></li>
                                    <li><a class="dropdown-item" href="#">Account</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="/logout">Sign out</a></li>
                                </ul>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>


    </header>
    <main class="min-vh-75 mt-5">
        <div class="container">
            <?php if (Application::$app->session->getFlash('succes')) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo Application::$app->session->getFlash('succes') ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="container">
            {{content}}
        </div>
    </main>
    <footer class="footer py-3 bg-dark mt-auto">
        <div class="container">
            <div class="d-flex justify-content-between">
                <ul class='list-unstyled text-small'>
                    <li><a class="link-secondary" href="#">About us</a></li>
                    <li><a class="link-secondary" href="#">Shipment</a></li>
                    <li><a class="link-secondary" href="#">Returns</a></li>

                </ul>
                <span class="text-white">© Building Market created by Damian Kuraś</span>
            </div>

        </div>
    </footer>
</body>

</html>