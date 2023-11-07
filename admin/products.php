<?php

if(isset($_GET['token'])) {

} else {
//        header("HTTP/1.1 403");
//        header("Location: login.html");
//        exit();
}
require_once __DIR__.'/../bootstrap.php';
require_once __DIR__.'/AdminController.php';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo $_ENV['URL']; ?>/admin/style.css">
    <link rel="stylesheet" href="<?php echo $_ENV['URL']; ?>/admin/dispatiching.css">
    <meta name="theme-color" content="#fcfcfc">
    <title>Necto Clothing - Dispatching</title>
</head>
<body>
<div id="modal">
    <div id="dispatch-tutorial" shown="false">
        <h2>How to dispatch</h2>
        <p>You can <b>swipe through the orders</b>, which aren't already packed or dispatched.</p>
        <p>If you want to package an order, find the <b>items listed in the overview</b>. If <b>all items</b> are <b>packed</b> klick the <b>'all packed'</b> button. After this, a <b>temporary ID</b> is shown to you. You will <b>write the temporary id</b> on the <b>package</b>.</p>
        <button id="allow-push-notification"><b>Ok</b>, start dispatching</button>
        <img src="<?php echo $_ENV['URL']; ?>/admin/dispatching-tutorial.png" width="900px" style="transform: translateX(-21%); margin-top: 25px">
    </div>
</div>
<div class="order-wrapper">
    <?php
    $orders = AdminController::getOrdersToDispatch();

    $loopNumber = 0;

    foreach ($orders as $order) {
        $loopNumber += 1;
        echo '<div>
            <div>
                <div class="space-between">
                    <h4>#'.$order['order_id'].'</h4>
                    <span class="marked">'.$loopNumber.' / '.count($orders).'</span>
                </div>
                <div class="space-between">
                    <div>
                        <p>'.$order['costumer_name'].'</p>
                        <p>'.$order['costumer_street'].',</p>
                        <p>'.$order['costumer_plz'].' '.$order['costumer_city'].'</p>
                        <p>'.$order['costumer_country'].'</p>
                    </div>
                    <div class="quick-links">
                        <a href="">view on Stripe</a>
                        <a href="">contact costumer</a>
                    </div>
                </div>
            </div>
            <div>';
        $items = database::select('order_products', ['conditions' => [['order_id', $order['ID']]]]);
        $items_loop = 0;
        foreach ($items as $item) {
            $items_loop += 1;
            echo '<div class="space-between">
                    <span><b>'.$item['product_name'].'</b></span>
                    <span>'.$item['product_color'].' | '.$item['product_size'].'</span>
                </div>';
            if(count($items) !== $items_loop) {
                echo '<hr>';
            }
        }

        echo '</div></div>';
    }
    ?>

    <div>
        <div style="border-top-style: solid">
            <h4>All done!</h4>
            <p>Go back to homepage or bring packages to the post office now.</p>
            <a href="."><button>go back to home</button></a>
        </div>
    </div>
</div>
<script>
    /*if(localStorage.getItem('dispatching-tutorial') !== null) {
        document.getElementById('dispatch-tutorial').shown = 'false';
    } else {
        localStorage.setItem('dispatching-tutorial', 'true');
    }*/
</script>
</body>
</html>
