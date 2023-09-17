<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class OrdersController extends Controller
{
    function process ()
    {
        $title = "Neue Bestellung";
        $body = "65€ - 3 Produkte - nach Deutschland";
        $deviceToken = "";

        $factory = (new Factory)->withServiceAccount('credentials.json');
        // Erstelle eine Messaging-Instanz
        $messaging = $factory->createMessaging();


        $notification = Notification::fromArray([
            'title' => $title,
            'body' => $body
        ]);

        $notification = Notification::create($title, $body);


        $message = CloudMessage::withTarget('token', $deviceToken)
            ->withNotification($notification) // optional
        ;

        $messaging->send($message);
    }
}
