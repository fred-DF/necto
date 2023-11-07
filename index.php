<?php

    require_once 'bootstrap.php';
    $items = database::select('products');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="msapplication-TileColor" content="#000000">
    <meta name="theme-color" content="#000000">
    <link rel="stylesheet" href="style.css">
    <title>Necto Clothing</title>
</head>
<body>
    <h1>Necto Clothing</h1>
    <div id="item_list">
        <?php
        foreach ($items as $item) {
                ?>
        <div class="item">
            <p class="sold_out_banner">new drop</p>
            <div class="img_container">
                <img src="<?php echo $item['product_pic_url'] ?>" alt="">
                <div class="text_container">
                    <div class="color_wrapper">
                        <div class="color_preview" style="background-color: #ff2929"></div>
                        <div class="color_preview" style="background-color: #e3e3e3"></div>
                        <div class="color_preview" style="background-color: #000000"></div>
                    </div>
                </div>
            </div>
            <h2><?php echo $item['product_name'] ?></h2>
            <div>
                <p><?php echo $item['product_price'] ?> BGR</p>
                <button onclick="window.location = 'item.php?item=<?php echo $item['ID']; ?>'">Buy</button>
            </div>
        </div>
                <?php
            }
        ?>
    </div>
    <div id="bg">
    </div>
    <script src="main.js"></script>
</body>
</html>