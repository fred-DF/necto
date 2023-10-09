<?php

if(isset($_GET['route'])) {
    $route = $_GET['route'];

    if($route === 'get-product-info') {
        if(isset($_GET['product-id'])) {
            include 'product.php';
            exit(json_encode(product::getInfo($_GET['product-id'])));
        }
    }
    if($route === 'create-checkout-session') {
        if(isset($_GET['shopping-cart'])) {
            $shoppingCart = json_decode($_GET['shopping-cart'], true);
            include 'stripe.php';
            Stripe::createCheckout($shoppingCart);
        }
    }
}