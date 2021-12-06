<?php
$this->title = 'All Orders List';
use app\models\Orders;
?>
<h1>All Orders List</h1>
<?php foreach ($orders as $model) { ?>

    <div class="row">
        <div class="col-sm">
            <p> <?php echo $model['id'] ?></p>
        </div>
        <div class="col-sm">
            <p><?php echo $order->getStatusLabel($model['status']) ?></p>
        </div>
        <div class="col-sm">
            <p> <?php echo $model['time'] ?></p>
        </div>
        <div class="col-sm">
                <a href="/admin/order?id=<?php echo $model['id'] ?>" class="btn btn-secondary">More infromation</a>
                
        </div>
        <div class="col-sm">
        <?php if ($model['status'] != ORDERS::STATUS_CANCELED && $model['status']!= ORDERS::STATUS_SENDED):?> 
        <a href="/admin/markAsSended?id=<?php echo $model['id'] ?>" class="btn btn-primary">Mark as sended</a>
        <?php endif;?>
        </div>


    </div>
<?php } ?>