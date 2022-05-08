<?php
$this->title = 'Building Market';
$_SESSION['rdrurl'] = $_SERVER['REQUEST_URI'];
?>
<div class="container-fluid min-vh-100">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5 mb-5 ">
        <div class="col-10 col-sm-8 col-lg-6">
            <picture>
                <source srcset="/assets/images/pexels-alexander-isreb-1797428.webp" type="image/webp">
                <img src="/assets/images/pexels-alexander-isreb-1797428.jpg" class="img-fluid mx-auto d-block" alt="hero image" width="1278" height="846">
            </picture>


        </div>
        <div class="col-lg-6 mb-5">
            <h1 class="display-5 fw-bold lh-1 mb-5">We sell high quality building materials.</h1>
            <p class="lead">High quality building materials delivered quickly to you.</p>
        </div>
        <div>
            <h3> See offers and learn more about us <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                </svg></h3>
        </div>
    </div>
</div>

<h2>Featured Products: </h2>
<div class="container-fluid min-vh-100">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-5 mt-5">
        <?php foreach ($featured as $model) { ?>
            <div class="col">
                <div class="card h-100">
                    <picture>
                        <source type="image/webp" srcset="<?php echo $model['image_link'] ?>.webp">
                        <img class="card-img-top h-100" src="<?php echo $model['image_link'] ?>.jpg" alt="product image" width="350" height="200"/>
                    </picture>

                    <div class="card-body">
                        <h3 class="card-title"> <?php echo $model['name'] ?></h3>
                        <p> <?php echo $model['category'] ?></p>
                        <p> <?php echo $model['brand'] ?></p>
                        <p> <?php echo $model['price'] ?>$</p>
                        <a class="btn btn-outline-secondary " href="/product?id=<?php echo $model['id'] ?>">More Info</a>
                    </div>

                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div class="mt-5 text-center">
    <h2 class="pb-2 border-bottom"> Our features: </h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        <div class="feature col">
            <div class="feature-icon bg-primary bg-gradient ">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                    <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                </svg>
            </div>
            <h2>Fast shipping</h2>
            <p>We will deliver your package next day</p>
            <a href="#" class="icon-link">
                More information

            </a>
        </div>
        <div class="feature col">
            <div class="feature-icon bg-primary bg-gradient">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                    <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z" />
                </svg>
            </div>
            <h2>Low prices</h2>
            <p>We do our best to provide your the best price posible and give extra discounts!</p>
            <a href="#" class="icon-link">
                More information
            </a>
        </div>
        <div class="feature col">
            <div class="feature-icon bg-primary bg-gradient">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-award" viewBox="0 0 16 16">
                    <path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z" />
                    <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z" />
                </svg>
            </div>
            <h2>Quality of service</h2>
            <p>Certified high quality services.</p>
            <a href="#" class="icon-link">
                More information
            </a>
        </div>
    </div>
</div>