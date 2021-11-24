<?php
$this->title = "$model->name";
?>
<div class="product-details">
<div class="product-details-image">
  <img src="<?php echo $model->imageLink ?>" alt="image"/>
</div>
<div class="product-property-wrap">
<div class="product-details-property">
    <p> Nazwa Produktu:</p>
    <p> <?php echo $model->name ?></p>
</div>
<div class="product-details-property">
    <p> Kategoria:</p>
    <p> <?php echo $model->category ?></p>
</div>


<div class="product-details-property">
    <p> Marka:</p>
    <p> <?php echo $model->brand ?></p>
</div>

<div class="product-details-property">
    <p> Cena: </p>
    <p> <?php echo $model->price?> zł</p>
</div>
<div class="product-details-property">
    <p> Dostępna ilość: </p>
    <p> <?php echo $model->quantityInStock?></p>
</div>
</div>

<div class="product-details-form">
<input type="number" id="quantity" min="0" max="<?php echo $model->quantityInStock ?>" class="product-add-input"/>
<button type="button" onClick="addToCartAsync()">Dodaj do koszyka</button>   
<p id="feedback"></p>
</div>
</div>
<div class="product-details-property">
  <?php echo $model->description ?>
</div>





<script>
function addToCartAsync(){
    if(document.getElementById('quantity').value<1){
      document.getElementById("feedback").style.color='red';
      document.getElementById("feedback").innerHTML = 'ilość musi być większa niż zero';
      return;
    }
    if(document.getElementById('quantity').value ><?php echo $model->quantityInStock ?>){
      document.getElementById("feedback").style.color='red';
      document.getElementById("feedback").innerHTML = 'nie mamy takiej ilosci produktu wybierz mniejsza ilosc';
      return;
    }
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("feedback").style.color='green';
          document.getElementById("feedback").innerHTML = this.response;
          document.getElementById("quant").innerHTML -= document.getElementById('quantity').value;
        }
      if(this.readyState == 4 && this.status == 403){
        document.getElementById("feedback").style.color='red';
        document.getElementById("feedback").innerHTML = 'najpierw się zaloguj';
        
      }
    }

  var quant= document.getElementById('quantity').value; 
  var requestText="/cart/add?product_id="+<?php echo $model->id ?> +"&quantity="+quant;
  xhttp.open("GET",requestText, true);
  xhttp.send();
}  
</script>
