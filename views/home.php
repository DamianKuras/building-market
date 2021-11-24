<?php
$this->title = 'Index';
?>
<div class="products-carousel" id="products-carousel">
    <?php foreach ($onSales as $model) { ?>
        <div class="products-carousel-item">
            <div class="product-image">
                <img src="<?php echo $model['imageLink'] ?>" alt="image" />
            </div>
            <div class="products-carousel-item-details">
                <div class="products-carousel-item-detail-property">
                    <p> Nazwa Produktu:</p>
                    <p> <?php echo $model['name'] ?></p>
                </div>
                <div class="products-carousel-item-detail-property">
                    <p> Marka:</p>
                    <p> <?php echo $model['brand'] ?></p>
                </div>
                <div class="products-carousel-item-detail-property">
                    <p> Cena: </p>
                    <p> <?php echo $model['price'] ?> zł</p>
                </div>
            </div>
            <div class="products-carousel-links">
                <a href="/product?id=<?php echo $model['id'] ?>">Więcej informacji</a>
            </div>
        </div>
    <?php } ?>
</div>
<div class="benefits">
    <h1> Co nas wyróżnia </h1>
    <div class="benefits-wrapper">
        <div class="benefits-item">
            <i class="fas fa-shipping-fast fa-7x"></i>
            <p class="benefist-description"> Ekspresowa wysyłka </p>
        </div>
        <div class="benefits-item">
            <i class="fas fa-award fa-7x"></i>
            <p class="benefist-description"> Przyjazna obsługa </p>
        </div>
        <div class="benefits-item">
            <i class="fas fa-dollar-sign fa-7x"></i>
            <p class="benefist-description"> Niskie ceny </p>
        </div>
    </div>
</div>

<script>
    window.onload = function() {
        var slider = document.getElementById('products-carousel'),
            isDown = !1,
            startX, scrollLeft;
        slider.addEventListener('mousedown', function(a) {
            isDown = !0;
            slider.classList.add('active');
            startX = a.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });
        slider.addEventListener('mouseleave', function() {
            isDown = !1;
            slider.classList.remove('active');
        });
        slider.addEventListener('mouseup', function() {
            isDown = !1;
            slider.classList.remove('active');
        });
        slider.addEventListener('mousemove', function(a) {
            isDown && (a.preventDefault(), a = 3 * (a.pageX - slider.offsetLeft - startX), slider.scrollLeft = scrollLeft - a);
        });
    }
</script>