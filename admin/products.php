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
    <link rel="stylesheet" href="<?php echo $_ENV['URL']; ?>/admin/products.css">
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
<div class="widget-wrapper">
    <a href="../admin" style="color: black; text-decoration: none">Home</a>
    <h1>Products</h1>
    <button onclick="window.location = '/admin/addProduct.php'">add new product</button>
    <div>
        <table class="products">
        <?php
        foreach (AdminController::getProducts() as $product) {
//            var_dump($product);
            ?>
            <tr>
                <td>
                    <img src="<?php echo $product['product_pic_url'] ?>" alt="">
                </td>
                <td>
                    <div>
                        <p><?php echo $product['product_name'] ?></p>
                        <div>
                            <span><?php echo  $product['product_price'] ?> BGR</span>
                            <span style="text-decoration: underline" onclick="window.location = 'editProduct.php?product_id=<?php echo $product['ID'] ?>'">more</span>
                        </div>
                    </div>
                </td>
            </tr>
        <?php
        }
        ?>
        </table>
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
