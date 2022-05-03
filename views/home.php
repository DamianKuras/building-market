<?php
$this->title = 'Building Market';
$_SESSION['rdrurl'] = $_SERVER['REQUEST_URI'];
?>
<div class="container-fluid min-vh-100">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5 mb-5 ">
    <div class="col-10 col-sm-8 col-lg-6">
        <img src="/assets/images/pexels-alexander-isreb-1797428.jpg" class="img-fluid mx-auto d-block" alt="Bootstrap Themes"  loading="lazy">
        
    </div>
    <div class="col-lg-6 mb-5">
        <h1 class="display-5 fw-bold lh-1 mb-5">We sell high quality building materials.</h1>
        <p class="lead">High quality building materials delivered quickly to you.</p>
    </div>
    <div>
    <h3> See offers and learn more about us <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
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
                <img class="card-img-top h-100" src="<?php echo $model['image_link'] ?>" alt="image" />
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
                <i class="fas fa-shipping-fast fa-3x"></i>
            </div>
            <h2>Fast shipping</h2>
            <p>We will deliver your package next day</p>
            <a href="#" class="icon-link">
                More information

            </a>
        </div>
        <div class="feature col">
            <div class="feature-icon bg-primary bg-gradient">
                <i class="fas fa-dollar-sign fa-3x"></i>
            </div>
            <h2>Low prices</h2>
            <p>We do our best to provide your the best price posible and give extra discounts!</p>
            <a href="#" class="icon-link">
                More information
            </a>
        </div>
        <div class="feature col">
            <div class="feature-icon bg-primary bg-gradient">
                <i class="fas fa-award fa-3x"></i>
            </div>
            <h2>Quality of service</h2>
            <p>Certified high quality services.</p>
            <a href="#" class="icon-link">
                More information
            </a>
        </div>
    </div>
</div>
