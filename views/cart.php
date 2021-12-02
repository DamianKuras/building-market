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
                                    <div class="w-25">
                                        <div class="input-group">
                                            <button class="btn btn-secondary" onclick="decrementQuantity()"><i class="fas fa-minus"></i></button>
                                            <input class="form-control" min="0" id="quanitity" name="quantity" value="<?php echo $model['quantity'] ?>" type="number">
                                            <button class="btn btn-secondary" onclick="incrementQuantity()"><i class="fas fa-plus"></i></button>
                                            <p class="mb-0">Price for one: <span><strong id="summary"><?php echo $model['price'] ?><p>$</p></strong></span></p class="mb-0">
                                            <p class="mb-0">Total: <span><strong id="totalForProduct">$</strong></span></p class="mb-0">
                                        </div>
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
        <div class="mb-3">
            <div class="pt-4">
                <h5 class="mb-4">Expected shipping delivery</h5>
                <p class="mb-0"> Thu., 12.03. - Mon., 16.03.</p>
            </div>
        </div>


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
                            <strong>The total</strong>
                            <strong>
                                <p class="mb-0">(including taxes)</p>
                            </strong>
                        </div>
                        <span><strong id="total"></strong></span>
                    </li>
                </ul>
                <a class="btn btn-primary" href="./checkout">go to checkout</a>
            </div>
        </div>
    </div>

    <!-- <div class="mb-5">
        <?php $form = app\base\form\Form::begin('', "post") ?>
        <h3>Payment</h3>
        <p>Not a real shop. Website created to learn more about programming. </p>
        <button class="btn btn-primary" type="submit" value="Submit">Make Order</button>
        <?php app\base\form\Form::end() ?>
    </div> -->  
    <script>
        function incrementQuantity() {
            var current = parseInt(event.currentTarget.parentElement.children[1].value);
            event.currentTarget.parentElement.children[1].value = current + 1;

        }

        function decrementQuantity() {
            var current = parseInt(event.currentTarget.parentElement.children[1].value);
            if (current - 1 > 0) {
                event.currentTarget.parentElement.children[1].value = current - 1;
            }

        }

        function handleProductQuantityChange(elem) {
            
        }

        function calculateTotalProductPrice() {

        }
    </script>
</div>