<?php

require_once '../bootstrap.php';
require_once 'order.php';

\Stripe\Stripe::setApiKey($_ENV['STRIPE_API_KEY']);

$endpoint_secret = $_ENV['STRIPE_ENDPOINT_SECRET'];

$input = @file_get_contents("php://input");
$event_json = json_decode($input);

if($event_json->type === 'checkout.session.completed') {
    Order::completeOrder($event_json);
    header("HTTP/1.1 200");
} else {
    #error_log(print_r($event_json, true));
}
