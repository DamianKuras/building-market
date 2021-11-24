<?php
$this->title = 'Zamówienia';
?>
<h1> Zamówienia</h1>

<?php foreach ($ordersModels as $model) { ?>
    <div class="orders-list">
        <h1> <?php echo $model['id'] ?></h1>
        <h1> <?php echo $model['time'] ?></h1>
        <a href="/order?id=<?php echo $model['id'] ?>">Szczegóły zamówienia</a>
    </div>

<?php } ?>