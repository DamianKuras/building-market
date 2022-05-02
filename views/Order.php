<?php
$this->title = "Order";
?>

<div>
    <div class="row mb-5">
        <div class="col-sm">
            <h3>Id: <?php echo $order->id ?></h3>
        </div>
        <div class="col-sm">
            <h3> <?php echo $order->time ?></h3>
        </div>
        <div class="col-sm">
            <h3>Status:  <?php echo $order->getStatusLabel($order->status) ?> </h3>
        </div>



    </div>

<div class="row">
    <div class="col-lg-8">
        <div class="mb-3">
            <div class="pt-4 wish-list">
                <h5 class="mb-4">Products ordered (<span><?php echo $orderItemsCount ?></span> products)</h5>
                <?php foreach ($orderedItemsModels as $model) { ?>
                    <div class="row mb-4">
                        <div class="col-md-5 col-lg-3 col-xl-3">
                            <div class="view zoom overlay z-depth-1 rounded mb-3 mb-md-0">
                                <img class="img-fluid w-100" src="<?php echo $model['imageLink'] ?>" alt="Product Image">
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-9 col-xl-9">
                            <div>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5><?php echo $model['name'] ?></h5>
                                        <p class="mb-3 text-muted text-uppercase small"><?php echo $model['brand'] ?></p>

                                    </div>
                                    <div class="w-25">
                                        <div class="input-group">
                                            <p class="" >Quantity: <?php echo $model['quantity'] ?></p>
                                            <p class="mb-0"><span><strong id="summary">Price each: <?php echo $model['price']?></strong></span></p class="mb-0">
                                            <p class="mb-0">Total: <span><strong id="totalForProduct"><?php echo number_format($model['price'] * $model['quantity'], 2) ?> $</strong></span></p class="mb-0">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                <?php } ?>



            </div>
        </div>
        <div class="mb-3">
            <div class="pt-4">
                <?php if ($order->status===2):?>
                    <h5 class="mb-4">Shipped on day</h5>
                    <p class="mb-0"> <?php echo  $order->shipping_day ?></p>
                <?php else: ?>
                <h5 class="mb-4">Expected shipping delivery</h5>
                <p class="mb-0"> <?php echo  $order->shipping_day ?></p>
                <?php endif;?>
            </div>
        </div>


    </div>

    <div class="col-lg-4 ">
        <div class="mb-3 position-sticky">
            <div class="pt-4">

                <h5 class="mb-3">The total price</h5>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                        Products:
                        <span><?php echo number_format($order->total_products_cost,2) ?> $</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        Shipping
                        <span><?php echo number_format($order->shipping_cost,2) ?> $</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                        <div>
                            <strong>The total</strong>
                            <strong>
                                <p class="mb-0">(including taxes)</p>
                            </strong>
                        </div>
                        <span><strong><?php echo number_format($order->shipping_cost + $order->total_products_cost,2) ?> $</strong></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>


</div>