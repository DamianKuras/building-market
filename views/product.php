<?php
$this->title = "$model->name";
$_SESSION['rdrurl'] = $_SERVER['REQUEST_URI'];
?>
<div class="row">
  <div class="col-md-6 mb-4">
    <img src=<?php echo $model->imageLink ?> class="d-block w-100" alt="...">
  </div>
  <div class="col-md-6">

    <h5><?php echo $model->name ?></h5>
    <p class="mb-2 text-muted text-uppercase small"><?php echo $model->category ?></p>
    <p><span class="mr-1"><strong><?php echo $model->price ?>$</strong></span></p>
    <p class="pt-1"><?php echo $model->description ?></p>
    <hr>
    <p>Avalible: <?php echo $model->quantityInStock ?></p>
    <div class="row">
      <div class="input-group col-lg m-2 ">
        <button class="btn btn-secondary" onclick="decrementQuantity()"><i class="fas fa-minus"></i></button>
        <input class="form-control text-center" type="number" id="quantity" min="0" max="<?php echo $model->quantityInStock ?>" value="1" class="product-add-input" />
        <button class="btn btn-secondary" onclick="incrementQuantity()"><i class="fas fa-plus"></i></button>
      </div>
      <div class="col-lg m-2">
        <button type="button" class="btn btn-primary" onClick="addToCart()"><i class="fas fa-shopping-cart mx-2"></i>Add to cart</button>
      </div>
      <div class="col-lg m-2">
        <p id="feedback" class=""></p>
      </div>
    </div>

  </div>
</div>


<script>
  function addToCart() {
    if (document.getElementById('quantity').value < 1) {
      document.getElementById("feedback").style.color = 'red';
      document.getElementById("feedback").innerHTML = 'Quantity must be greater than 0';
      return;
    }
    if (document.getElementById('quantity').value > <?php echo $model->quantityInStock ?>) {
      document.getElementById("feedback").style.color = 'red';
      document.getElementById("feedback").innerHTML = 'We dont have this many. Select lower amount';
      return;
    }
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("feedback").style.color = 'green';
        document.getElementById("feedback").innerHTML = this.response;
      }
      if (this.readyState == 4 && this.status == 403) {
        document.getElementById("feedback").style.color = 'red';
        document.getElementById("feedback").innerHTML = 'U need to sing in first.';

      }
    }
    var quant = document.getElementById('quantity').value;
    var requestText = "/cart/add";

    xhttp.open("POST", requestText, true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("product_id=" + <?php echo $model->id ?> + "&quantity=" + quant);
  }

  function incrementQuantity() {
    var current = parseInt(document.getElementById("quantity").value);
    if (current < <?php echo $model->quantityInStock ?>)
      document.getElementById("quantity").value = current + 1;
  }

  function decrementQuantity() {
    var current = parseInt(document.getElementById("quantity").value);
    if (current - 1 > 0) {
      document.getElementById("quantity").value = current - 1;
    }
  }
</script>