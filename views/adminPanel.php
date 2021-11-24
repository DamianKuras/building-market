<?php
$this->title = 'Admin';
?>
<h1>Wiaj administratorze</h1>

<?php foreach ($orders as $model) { ?>

    <div class="admin-order-list-item">
        <h1> <?php echo $model['id'] ?></h3>
            <h1><?php echo $order->getStatusLabel($model['status']) ?></h1>
            <h1> <?php echo $model['time'] ?></h1>
            <div class="admin-order-list-links">
                <a href="/admin/order?id=<?php echo $model['id'] ?>">Więcej informacji</a>
                <a href="/admin/markAsSended?id=<?php echo $model['id'] ?>">Zmień status na wysłane</a>
            </div>
    </div>
<?php } ?>