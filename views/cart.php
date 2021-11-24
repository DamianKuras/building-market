<h1>Koszyk</h1>
<div class="cart-items">
    <?php foreach ($orderedItemsModels as $model) { ?>
        <div class="cart-item">
            <div class="cart-item-image">
                <img src="<?php echo $model['imageLink'] ?>" alt="image">
            </div>

            <div class="cart-item-details">
                <h1> <?php echo $model['name'] ?></h1>
                <h3> <?php echo $model['brand'] ?></h3>
                <p> <?php echo $model['quantity'] ?></p>
            </div>

            <div class="cart-item-remove">
                <a href="/cart/remove?product_id=<?php echo $model['product_id'] ?>">Usuń</a>
            </div>
        </div>

    <?php } ?>
</div>
<?php $form = app\base\form\Form::begin('', "post") ?>
<button type="submit" value="Submit">złóż zamówienie</button>
<?php app\base\form\Form::end() ?>
</div>