<?php
$this->title = "$model->name";
$_SESSION['rdrurl'] = $_SERVER['REQUEST_URI'];
?>
<div class="row">
  <div class="col-md-4 mb-4">
    <picture>
      <source type="image/webp" srcset="<?php echo $model->image_link ?>.webp">
      <img src="<?php echo $model->image_link ?>.jpg" class="d-block w-100" alt="product image" width="350" height="200">
    </picture>

  </div>
  <div class="col-md-6">

    <h5><?php echo $model->name ?></h5>
    <p class="mb-2 text-muted text-uppercase small"><?php echo $model->category ?></p>
    <p><span class="mr-1"><strong><?php echo $model->price ?>$</strong></span></p>
    <p class="pt-1"><?php echo $model->description ?></p>
    <hr>
    <p>Available: <?php echo $model->quantity_in_stock ?></p>
    <div class="row">
      <div class="input-group col-lg m-2 ">
        <button class="btn btn-secondary" onclick="decrementQuantity()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-lg" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8Z" />
          </svg></button>
        <input class="form-control text-center" type="number" id="quantity" min="0" max="<?php echo $model->quantity_in_stock ?>" value="1" class="product-add-input" />
        <button class="btn btn-secondary" onclick="incrementQuantity()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
          </svg></button>
      </div>
      <div class="col-lg m-2">
        <button type="button" class="btn btn-primary" onClick="addToCart()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
          </svg>Add to cart</button>
      </div>
    </div>
    <div class="col-lg m-2">
      <p id="feedback" class=""></p>
    </div>

  </div>
</div>


<script>
  function addToCart() {
    var quant = parseInt(document.getElementById('quantity').value);
    if (quant < 1) {
      document.getElementById("feedback").style.color = 'red';
      document.getElementById("feedback").innerHTML = 'Quantity must be greater than 0';
      return;
    }
    if (quant > <?php echo $model->quantity_in_stock ?>) {
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

    var requestText = "/cart/add";
    xhttp.open("POST", requestText, true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("product_id=" + <?php echo $model->id ?> + "&quantity=" + quant);
  }

  function incrementQuantity() {
    var current = parseInt(document.getElementById("quantity").value);
    if (current < <?php echo $model->quantity_in_stock ?>)
      document.getElementById("quantity").value = current + 1;
  }

  function decrementQuantity() {
    var current = parseInt(document.getElementById("quantity").value);
    if (current - 1 > 0) {
      document.getElementById("quantity").value = current - 1;
    }
  }
</script>