<?php

use app\base\Application;

$this->title = 'Produkty';
?>
<h1>Produkty</h1>

<div class="product-cards">
<?php foreach ($products as $model) {?>
    <div class="product-card"> 
        <div class="product-image">
            <img src="<?php echo $model['imageLink'] ?>" alt="image"/>
        </div>
        <div>
            <div class="product-card-property">
                <p> Nazwa Produktu:</p>
                <p> <?php echo $model['name'] ?></p>
            </div>
            <div class="product-card-property">
                <p> Kategoria:</p>
                <p> <?php echo $model['category'] ?></p>
            </div>
            <div class="product-card-property">
                <p> Marka:</p>
                <p> <?php echo $model['brand'] ?></p>
            </div>
            <div class="product-card-property">
                <p> Cena: </p>
                <p> <?php echo $model['price']?> zł</p>
            </div>
        </div>
        <div class="product-card-link">
            <a href="/product?id=<?php echo $model['id']?>" >More Info</a>
        </div>
    </div>
<?php } ?>
</div>