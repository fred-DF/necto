<?php

if(isset($_GET['route'])) {
    $route = $_GET['route'];

    switch ($route) {
        case 'get-product-info':
            if(isset($_GET['product-id'])) {
                include 'product.php';
                exit(json_encode(product::getInfo($_GET['product-id'])));
            }
            break;

        case 'create-checkout-session':
            if(isset($_GET['shopping-cart'])) {
                $shoppingCart = json_decode($_GET['shopping-cart'], true);
                include 'stripe.php';
                Stripe::createCheckout($shoppingCart);
            }
            break;

        case 'checkout':
            include 'order.php';
            $data = Order::prepareOrder([
                ['stripe_price_id'=>'price_1NsJqTB0uesfVsSs85bB0UJq','id'=>1,'color'=>'red','size'=>'M','name'=>'Mixed Feelings'],
                ['stripe_price_id'=>'price_1NsJqTB0uesfVsSs85bB0UJq','id'=>1,'color'=>'red','size'=>'M','name'=>'Mixed Feelings']
            ]);
            $data = json_decode($data);
            header("HTTP/1.1 403");
            header("Location: ".$data->redirect_url);
            break;

        default:
            header('HTTP/1.1 400 Invalid Route');
            die('Invalid route');
    }
}
