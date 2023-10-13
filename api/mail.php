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
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $_ENV['SMTP_SERVER_PORT'];
            $mail->CharSet = 'UTF-8';
            $mail->ContentType = 'text/html; charset=UTF-8';

            $mail->setFrom('support@necto.genanntnoelke.de', 'Necto Clothing');
            $mail->addAddress($orderInforation['email'], $orderInforation['name']);

            $mail->isHTML(true);
            $mail->Subject = 'Your Necto Order Confirmation - Thank you for your purchase!';
            $mail->Body    = '
Dear '.$orderInforation['name'].',

Thank you for shopping with Necto! We are delighted to confirm that your order #'.$orderInforation['orderId'].' has been received and is now being processed.

<h2>Order Summary</h2>:

Order Number: #'.$orderInforation['orderId'].'
Order Date: '.$orderInforation['orderDate'].'
Purchased Items:

[Loop through ordered items]

Item: [Item Name]
Size: [Size]
Color: [Color]
Quantity: [Quantity]
Price: [Price]
[/Loop]

Total Amount Paid: '.$orderInforation['totalAmount'].'

You can view and download your invoice by clicking on the following link: '.$orderInforation['invoiceLink'].'

Shipping Address:

'.$orderInforation['shipping_address'].'

Billing Address:

'.$orderInforation['billing_address'].'

Your order will be dispatched as soon as possible. Once your items have been shipped, you will receive an email with your tracking information.

If you have any questions or need to make changes, please contact our Customer Service team as soon as possible, quoting your order number.

<h3>Return & Exchange Policy</h3>:

Remember, if you’re not completely satisfied with your items, you can return or exchange them within [Return Period] days of receipt according to our [Return Policy Link] - because your satisfaction is our priority.

<h3>Stay Connected</h3>:

Don’t forget to follow us on Instagram @necto_clothing.

Thank you for choosing Necto and happy shopping!

Warm regards,

The Necto Team

Contact Us:

Email: support@necto.com
Phone: +015253036123
            ';
            $mail->AltBody = 'For moor information activate HTML Mails *** We want to inform you, that your order is being processed rigth now! Thank you and happy shopping! Necto Team';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }
}

Mail::orderConfirmation(['email' => 'frederik@genanntnoelke.de', 'name' => 'Frederik Nölke', 'orderId' => 'DE982340', 'orderDate' => '13.10.20203', 'totalAmount' => "BGR 150", 'invoiceLink' => 'example.com', 'shipping_address' => 'Sperlichstr. 62, 48151 Münster', 'billing_address' => 'Sperlichstr. 62, 4851 Münster']);
