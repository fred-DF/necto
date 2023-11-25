<?php

if(isset($_GET['route'])) {
    $route = $_GET['route'];
} elseif(isset($_POST['route'])) {
    $route = $_POST['route'];
} else {
    exit("Keine Route angegeben");
}

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
//            $data = Order::prepareOrder([
//                ['stripe_price_id'=>'price_1NsJqTB0uesfVsSs85bB0UJq','id'=>1,'color'=>'red','size'=>'M','name'=>'Mixed Feelings'],
//                ['stripe_price_id'=>'price_1NsJqTB0uesfVsSs85bB0UJq','id'=>1,'color'=>'red','size'=>'M','name'=>'Mixed Feelings']
//            ]);
        $data = Order::prepareOrder(json_decode($_GET['shopping-cart'], true));
        $data = json_decode($data);
        var_dump($data);
        if($data->error) {
            header("HTTP/1.1 301");
            header("Location: /shopping-cart.php?productSoldOut");
            exit();
        }
        header("HTTP/1.1 301");
        header("Location: ".$data->redirect_url);
        break;

    case 'updateStock':
        include_once '../database.php';
        $color = $_GET['color'];
        $size = $_GET['size'];
        $stock = $_GET['stockValue'];
        var_dump(database::executeQuery("UPDATE `product_variants` SET `stock`='$stock' WHERE `product_color`='$color' && `product_size`='$size'"));
        break;

    case 'createProduct':
        include 'product.php';
        product::createProduct($_POST['data']);
        break;

    default:
        header('HTTP/1.1 400 Invalid Route');
        die('Invalid route');
}
