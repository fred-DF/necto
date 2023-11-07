<?php

require_once '../bootstrap.php';
require_once 'stripe.php';
require_once 'mail.php';

class Order
{
    public static function prepareOrder ($shopping_cart) {
        # $shopping_cart = [['stripe_price_id','id','color','size','name'],...]
        $stripe_products = [];
        foreach ($shopping_cart as $product) {
            $stripe_products[] = ['price' => $product['stripe_price_id'], 'quantity' => 1];
        }
        $checkoutElement = Stripe::createCheckout($stripe_products);

        $stripe_checkout_session_id = $checkoutElement['session_id'];
        $totalItemCount = count($shopping_cart);

        database::executeQuery("INSERT INTO `orders`(`stripe_id`,`item_count`) VALUES ('{$stripe_checkout_session_id}', '{$totalItemCount}')");
        $id = database::select('orders', ['conditions' => [['stripe_id',$stripe_checkout_session_id]]])[0]['ID'];

        foreach ($shopping_cart as $product) {
            database::executeQuery("INSERT INTO `order_products`(`order_id`, `product_id`, `product_name`, `product_color`, `product_size`) VALUES ('".$id."','".$product['id']."','".$product['name']."','".$product['color']."','".$product['size']."')");
        }

        return json_encode($checkoutElement);
    }

    public static function completeOrder ($paymentData) {

        $mail = $paymentData->data->object->customer_details->email;
        $name = $paymentData->data->object->shipping_details->name;
        $address_line1 = $paymentData->data->object->shipping_details->address->line1;
        $address_line2 = $paymentData->data->object->shipping_details->address->line2;
        $address_city = $paymentData->data->object->shipping_details->address->city;
        $address_country = $paymentData->data->object->shipping_details->address->country;
        $address_postal_code = $paymentData->data->object->shipping_details->address->postal_code;
        $address_state = $paymentData->data->object->shipping_details->address->state;
        $amount = $paymentData->data->object->amount_total / 100;
        $currency = $paymentData->data->object->currency;
        $id = $paymentData->data->object->id;
        $shipping_cost = $paymentData->data->object->shipping_cost->amount_total / 100;
        $shipping_rate = $paymentData->data->object->shipping_cost->shipping_rate;

        $orderID = $address_country.strtoupper(uniqid());

        $sqlQuery = "
            UPDATE `orders` SET 
            `order_id`='$orderID',
            `state`='payed',
            `payment_status`='".$paymentData->data->object->payment_status."',
            `costumer_name`='".$name."',
            `costumer_email`='".$mail."',
            `costumer_tel`='',
            `costumer_country`='".$address_country."',
            `costumer_city`='".$address_city."',
            `costumer_plz`='".$address_postal_code."',
            `costumer_street`='".$address_line1."',
            `billing_address`='".$address_line1."',
            `shipping_cost`='".$shipping_cost."',
            `shipping_rate`='".$shipping_rate."',
            `price_total`='".$amount."'
            WHERE `stripe_id`='".$id."'
        ";
        database::executeQuery($sqlQuery);
        header("HTTP/1.1 200");
        Mail::orderConfirmation(['email' => $mail, 'name' => $name, 'orderId' => $orderID, 'orderDate' => $paymentData->data->object->created, 'totalAmount' => $amount." ".$currency, 'invoiceLink' => 'example.com', 'shipping_address' => $address_line1.", ".$address_postal_code." ".$address_city, 'billing_address' => $address_line1]);

    }
}

