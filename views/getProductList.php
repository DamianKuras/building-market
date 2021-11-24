<?php

$this->title = 'Lista prouktów';
?>
<div class="cart-items">
    <?php foreach ($productModels as $model) { ?>
        <div id="<?php echo $model['id'] ?>" class="cart-item">
            <div class="cart-image">
                <img src="<?php echo $model['imageLink'] ?>" alt="image"/>
            </div>
            <div class="cart-item-details">

                <h1> <?php echo $model['name'] ?></h1>
                <h1> <?php echo $model['price'] ?> zł</h1>
                <h1> <?php echo $model['category'] ?></h1>
                <h1> <?php echo $model['brand'] ?></h1>
            </div>
            <div class="cart-item-remove">
                <a href="/product?id=<?php echo $model['id'] ?>">Strona Produktu</a>
                <a href="/admin/editProduct?id=<?php echo $model['id'] ?>">Edytuj produkt</a>
                <a href="#" onClick="RemoveProductAsync(<?php echo $model['id'] ?>)">Usuń Produkt</a>
            </div>

        </div>
    <?php } ?>
</div>
<script>
    function RemoveProductAsync(product_id) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(product_id).style.display = 'none';

            }
        }
        var requestText = "/admin/removeProduct?id=" + product_id;
        xhttp.open("GET", requestText, true);
        xhttp.send();
    }
</script>