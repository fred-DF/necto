<?php

require_once '../bootstrap.php';

\Stripe\Stripe::setApiKey($_ENV['STRIPE_API_KEY']);
header('Content-Type: application/json');

class Stripe {
    public static function createCheckout ($shoppingCart) {
//        var_dump($shoppingCart);
//        exit();
        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => $shoppingCart,
            'mode' => 'payment',
            'success_url' => $_ENV['URL'] . $_ENV['PAYMENT_SUCCESS_URI'],
            'cancel_url' => $_ENV['URL'] . $_ENV['PAYMENT_FAIL_URI'],
            'shipping_address_collection' => [
                'allowed_countries' => ['DE', 'US', 'CA', 'GB', 'BG'],
            ],
        ]);

        header("HTTP/1.1 303 See Other");
        header("Location: " . $checkout_session->url);
    }
}