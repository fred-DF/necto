<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../bootstrap.php';
require_once '../vendor/autoload.php';

set_time_limit(5);

Class Mail {
    public static function orderConfirmation ($orderInforation) {

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 2;

        try {
            $mail->isSMTP();
            $mail->Host = $_ENV['SMTP_SERVER'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['SMTP_USERNAME'];
            $mail->Password = $_ENV['SMTP_PASSWORD'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = $_ENV['SMTP_SERVER_PORT'];
            $mail->CharSet = 'UTF-8';
            $mail->ContentType = 'text/html; charset=UTF-8';

            $mail->setFrom('support@necto.genanntnoelke.de', 'Necto Clothing');
            $mail->addAddress($orderInforation['email'], $orderInforation['name']);

            $mail->isHTML(true);
            $mail->Subject = 'Your Necto Order Confirmation - Thank you for your purchase!';
            $message = file_get_contents(__DIR__.'/mail_templates/order_confirmation.html');
            $message = str_replace("{{name}}", $orderInforation['name'], $message);
            $message = str_replace("{{order_id}}", $orderInforation['orderId'], $message);
            $message = str_replace("{{order_date}}", date('d.m.Y H:i', $orderInforation['orderDate']), $message);
            $message = str_replace("{{amount_paid}}", $orderInforation['totalAmount'], $message);
            $message = str_replace("{{shipping_address}}", $orderInforation['shipping_address'], $message);
            $message = str_replace("{{billing_address}}", $orderInforation['billing_address'], $message);
            $message = str_replace("\n", "<br>", $message);

            $mail->Body = $message;
            $mail->AltBody = 'For more information activate HTML Mails *** We want to inform you, that your order is being processed rigth now! Thank you and happy shopping! Necto Team';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }
}

// ['emil', 'name', 'orderId', 'orderDate', 'totalAmount', 'invoiceLink', 'shipping_address', 'billing_address']

