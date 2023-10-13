<?php

require_once '../bootstrap.php';
require_once 'order.php';

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
            'shipping_options' => [
                [
                    'shipping_rate_data' => [
                        'type' => 'fixed_amount',
                        'fixed_amount' => [
                            'amount' => 0,
                            'currency' => 'bgn',
                        ],
                        'display_name' => 'Free shipping',
                        'delivery_estimate' => [
                            'minimum' => [
                                'unit' => 'business_day',
                                'value' => 5,
                            ],
                            'maximum' => [
                                'unit' => 'business_day',
                                'value' => 7,
                            ],
                        ],
                    ],
                ],
                [
                    'shipping_rate_data' => [
                        'type' => 'fixed_amount',
                        'fixed_amount' => [
                            'amount' => 1500,
                            'currency' => 'bgn',
                        ],
                        'display_name' => 'Next day',
                        'delivery_estimate' => [
                            'minimum' => [
                                'unit' => 'business_day',
                                'value' => 1,
                            ],
                            'maximum' => [
                                'unit' => 'business_day',
                                'value' => 1,
                            ],
                        ],
                    ],
                ],
            ],
        ]);

        return ['session_id' => $checkout_session->id, 'redirect_url' => $checkout_session->url];
    }
}