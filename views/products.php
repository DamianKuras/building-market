<?php

use app\base\Application;

$_SESSION['rdrurl'] = $_SERVER['REQUEST_URI'];
$this->title = 'Products';
?>

<h1 class="mt-5">Products: </h1>
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-2 mt-2">
    <?php if (count($products) == 0) : ?>
        <h2 class="bg-warning text-white">No products were found matching your criteria.</h2>
    <?php else : ?>
        <?php foreach ($products as $model) { ?>
            <div class="col">
                <div class="card h-100">
                    <picture>
                        <source type="image/webp" srcset="<?php echo $model['image_link'] ?>.webp">
                        <img class="card-img-top h-100" src="<?php echo $model['image_link'] ?>.jpg" alt="image" />
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
    <?php endif; ?>

</div>