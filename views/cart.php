<?php
$this->title = 'Cart';
?>
<h1>Cart</h1>
<div class="row">
    <div class="col-lg-8">
        <div class="mb-3">
            <div class="pt-4 wish-list">
                <h5 class="mb-4">Cart (<span><?php echo $cartItemsCount ?></span> items)</h5>
                <?php foreach ($orderedItemsModels as $model) { ?>
                    <div class="row mb-4">
                        <div class="col-md-5 col-lg-3 col-xl-3">
                            <div class="view zoom overlay z-depth-1 rounded mb-3 mb-md-0">
                                <img class="img-fluid w-100" src="<?php echo $model['imageLink'] ?>" alt="Product Image">
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-9 col-xl-9">
                            <div>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5><?php echo $model['name'] ?></h5>
                                        <p class="mb-3 text-muted text-uppercase small"><?php echo $model['brand'] ?></p>

                                    </div>
                                    <div class="w-50">
                                        <div class="input-group">
                                            <button class="btn btn-secondary" onclick="decrementQuantity()"><i class="fas fa-minus"></i></button>
                                            <input class="form-control" min="0" max=<?php echo $model['quantityInStock'] ?> id="quanitity" name="quantity" value="<?php echo $model['quantity'] ?>" type="number" onchange="QuantityChange()">
                                            <button class="btn btn-secondary" onclick="incrementQuantity()"><i class="fas fa-plus"></i></button>
                                            <input type="hidden" value=<?php echo $model['product_id'] ?> />
                                        </div>

                                        <p class="mb-0">Price for one: <span><strong id="summary"><span><?php echo $model['price'] ?></span> $</strong></span></p class="mb-0">
                                        <p class="mb-0">Total: <span><strong><span class="productTotal"><?php echo number_format($model['price'] * $model['quantity'], 2) ?></span>$</strong></span></p class="mb-0">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <a href="/cart/remove?product_id=<?php echo $model['product_id'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt mr-1"></i> Remove item </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                <?php } ?>



            </div>
        </div>
        <?php if ($cartItemsCount > 0) : ?>
            <div class="mb-5">
                <div class="pt-4">
                    <h5 class="mb-4">Expected shipping delivery</h5>
                    <p class="mb-0"><?php echo $expectedShippingDay ?></p>
                </div>
            </div>
        <?php endif; ?>


    </div>

    <div class="col-lg-4 ">
        <div class="mb-3 position-sticky">
            <div class="pt-4">

                <h5 class="mb-3">The total price of</h5>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                        Products:
                        <span><strong id="productsPrice"></strong></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        Shipping
                        <span>$10</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                        <div>
                            <strong>Total Prodcuts price</strong>
                            <strong>
                                <p class="mb-0">(including taxes without shipping)</p>
                            </strong>
                        </div>
                        <span><strong><span id="totalPrice"></span> $</strong></span>
                    </li>
                </ul>
                <?php $form = app\base\form\Form::begin('', "post") ?>
                <h3>Payment</h3>
                <p>Not a real shop. Website created to learn more about programming. </p>
                <button class="btn btn-primary" type="submit" value="Submit">Make Order</button>
                <?php app\base\form\Form::end() ?>
            </div>
        </div>
    </div>
        
    <script>
        function debounce(func, timeout = 500) {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    func.apply(this, args);
                }, timeout);
            };z
        }

        function saveInput(id, quantity) {
            var xhttp = new XMLHttpRequest();
            var requestText = "/cart/set-product-quantity";
            xhttp.open("POST", requestText, true);
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhttp.send("product_id=" + id + "&quantity=" + quantity);
        }
        const processChange = debounce((id, quantity) => saveInput(id, quantity));
        window.onload = handleProductQuantityChange;

        function incrementQuantity() {
            var current = parseInt(event.currentTarget.parentElement.children[1].value);
            if (current + 1 <= event.target.parentElement.children[1].max) {
                event.currentTarget.parentElement.children[1].value = current + 1;
                event.currentTarget.parentElement.children[1].dispatchEvent(new Event('change'))
            }

        }

        function decrementQuantity() {
            var current = parseInt(event.currentTarget.parentElement.children[1].value);
            if (current - 1 > 0) {
                event.currentTarget.parentElement.children[1].value = current - 1;
                event.currentTarget.parentElement.children[1].dispatchEvent(new Event('change'))
            }

        }

        function QuantityChange() {
            var amount=event.currentTarget.value;
            var price = parseFloat(event.currentTarget.parentElement.parentElement.children[1].children[0].children[0].children[0].innerHTML);
            var totalForProduct = amount * price;
            event.currentTarget.parentElement.parentElement.children[2].children[0].children[0].children[0].innerHTML = totalForProduct;
            handleProductQuantityChange();
            var productId=parseInt(event.currentTarget.parentElement.children[3].value);
            processChange(productId, amount);
        }


        function handleProductQuantityChange() {
            const sum = [...document.querySelectorAll('span.productTotal')].reduce((acc, valueSpan) => {
                return acc + parseFloat(valueSpan.innerHTML)
            }, 0)

            document.getElementById("totalPrice").innerHTML = sum;
        }

        
    </script>
</div>