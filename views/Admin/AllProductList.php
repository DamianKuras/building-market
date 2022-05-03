<?php

$this->title = 'Product List';
?>
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-2 mt-2">
    <?php foreach ($productModels as $model) { ?>
        <div class="col" id=<?php echo $model['id'] ?> >
            <div class="card h-100">
                <img class="card-img-top h-100" src="<?php echo $model['image_link'] ?>" alt="image" />
                <div class="card-body">
                    <h3 class="card-title"> <?php echo $model['name'] ?></h3>
                    <p> <?php echo $model['category'] ?></p>
                    <p> <?php echo $model['brand'] ?></p>
                    <p> <?php echo $model['price'] ?>$</p>
                    <div class="input-group mb-3">
                        <a href="/product?id=<?php echo $model['id'] ?>" class="btn btn-secondary">Visit Product Page</a>
                    </div>
                    <div class="input-group mb-3">
                        <a href="/admin/edit-product?id=<?php echo $model['id'] ?>" class="btn btn-warning">Edit Product</a>
                    </div>
                    <div class="input-group ">
                        <a href="#" onClick="RemoveProductAsync(<?php echo $model['id'] ?>)" class="btn btn-danger">Delete Prdoduct</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<script>
    function RemoveProductAsync(product_id) {
        event.preventDefault();
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(product_id).style.display = 'none';
            }
        }
        var requestText = "/admin/remove-product";
        xhttp.open("POST", requestText, true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.send("id=" + product_id);
    }
</script>