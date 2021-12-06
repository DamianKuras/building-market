<?php
$this->title = "Zamówienie";
use app\models\Orders;
?>

<div class="row">
    <div class="col-sm">
    <p> <?php echo $order->id ?></p>
    </div>
    <div class="col-sm">
    <p> <?php echo $order->time ?></p>
    </div>
    <div class="col-sm">
    <h1> <?php echo Orders::getStatusLabel($order->status) ?> </h1>
    </div>
</div>
<h1>Products </h1>
<div class="cart-items">
    <?php foreach ($orderedItemsModels as $model) { ?>

        <div class="cart-item">
            <div class="cart-item-image">
                <img src="<?php echo $model['imageLink'] ?>" class="cart-item-image" alt="image" />
            </div>

            <div class="cart-item-details">
                <h2> <?php echo $model['name'] ?></h2>
                <h2> <?php echo $model['brand'] ?></h2>
                <h2> <?php echo $model['quantity'] ?></h2>
            </div>


        </div>
    <?php } ?>
    <?php if ($order->status != ORDERS::STATUS_CANCELED && $order->status != ORDERS::STATUS_SENDED):?> 
    <div class=" mb-5">
        <a href="/admin/markAsSended?id=<?php echo $order->id ?>" class="btn btn-primary">Mark as sended</a>
    </div>

    <?php endif;?>
</div>