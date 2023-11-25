<?php

if(!isset($_GET['product_id'])) {
    header('Location: products.php');
    exit();
}

require_once __DIR__.'/../bootstrap.php';
require_once __DIR__.'/AdminController.php';

$product = AdminController::getProductData($_GET['product_id']);

if(count($product) !== 1) {
    header('Location: products.php');
    exit();
}

$product = $product[0];

//var_dump($product);

?>
<doctype html>
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
    <a href="products.php" style="color: black; text-decoration: none"> ⃪ back</a>
    <h1><?php echo $product['product_name'] ?></h1>
    <p><?php echo $product['product_price'] ?> BGR</p>
<!--    <img src="--><?php //echo $product['product_pic_url'] ?><!--" alt="" style="width: 100%; aspect-ratio: 16/9; object-fit: cover; border-radius: 15px">-->
    <div>
            <?php
                foreach (AdminController::getProductVariants($_GET['product_id']) as $variant) {
                    ?>

        <div class="stock_amount_wrapper">
            <p><span class="bold"><?php echo $variant['product_size'] ?></span> in <span class="bold"><?php echo $variant['product_color'] ?></span></p>
            <input type="tel" name="" id="<?php echo $variant['product_size']."_".$variant['product_color'] ?>" value="<?php echo $variant['stock'] ?>" oninput="updateStock(<?php echo "'".$variant['product_size']."','".$variant['product_color']."','".$variant['product_size']."_".$variant['product_color']."'" ?>)">
        </div>
                    <?php
                }

            ?>
        
    </div>
</div>
<script>
    function updateStock(size, color, id) {
        stock = document.getElementById(id).value;
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "/api/api.php?route=updateStock&color=" + color + "&size=" + size + "&stockValue=" + stock);
        xhr.onreadystatechange = () => {
            if(xhr.status !== 200) {
                alert("Error " + xhr.status + " while saving input");
            }
        };
        xhr.send();
    }
</script>
</body>
</html>

