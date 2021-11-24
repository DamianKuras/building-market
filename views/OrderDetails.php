<?php
$this->title = "Zamówienie";
?>

<div class="orders-list">
            <h1> <?php echo $order->id?></h1>
            <h1> <?php echo $order->time?></h1>
            <h1> <?php echo $order->getStatusLabel($order->status) ?> </h1>
    </div>
<h1>Produkty: </h1>
<div class="cart-items">
<?php foreach ($orderedItemsModels as $model) {?>
    
        <div class="cart-item">
            <div class="cart-item-image">
                <img src="<?php echo $model['imageLink'] ?>" class="cart-item-image" alt="image"/>
            </div>
       
        <div class="cart-item-details"> 
            <h2> <?php echo $model['name'] ?></h2>
            <h2> <?php echo $model['brand'] ?></h2>
            <h2> <?php echo $model['quantity'] ?></h2>
        </div>

 
    </div>
<?php } ?>
<div class="cart-item-remove">
            <a href="/admin/markAsSended?id=<?php echo $order->id ?>">Zmień status na wysłane</a>
        </div>
</div>
