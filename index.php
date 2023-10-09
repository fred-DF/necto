<?php

    require_once 'bootstrap.php';
    $items = database::select('products', ['conditions' => [["product_price", "35"]]]);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
            <img src="<?php echo $item['product_pic_url'] ?>" alt="">
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