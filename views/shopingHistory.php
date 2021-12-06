<?php
$this->title = 'Shopping History';
use app\models\Orders;
?>
<h1> Shopping History</h1>
<div>
    <?php foreach ($ordersModels as $model) { ?>
        <div class="row">
            <div class="col-sm">
                <p> <?php echo $model['id'] ?></p>
            </div>
            <div class="col-sm">
                <p> <?php echo $model['time'] ?></p>
            </div>
            <div class="col-sm">
                <p> <?php echo Orders::getStatusLabel($model['status']) ?></p>
            </div>
            <div class="col-sm">
                <a href="/order?id=<?php echo $model['id'] ?> " class="btn btn-secondary">Order Details</a>
            </div>
        </div>
    
    <?php } ?>
</div>