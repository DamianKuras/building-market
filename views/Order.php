<?php
$this->title = "Zamówienie";
?>

<div>
    <div class="orders-list">
            <h1> <?php echo $order->id?></h1>
            <h1> <?php echo $order->time?></h1>
            <h1> <?php echo $order->getStatusLabel($order->status) ?> </h1>
    </div>
    <h1>Produkty: </h1>
    <div>
    <?php foreach ($orderedItemsModels as $model) {?>
        <div class="order-details"> 
            <img src="<?php echo $model['imageLink'] ?>" class="cart-item-image" alt="image"/>
            <h2> <?php echo $model['name'] ?></h2>
            <h2> <?php echo $model['brand'] ?></h2>
            <h2> <?php echo $model['quantity'] ?></h2>
        </div>
    <?php } ?>

    </div>

</div>