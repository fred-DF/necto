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
    <nav>
        <h1>Necto Clothing</h1>
        <i class="bi bi-cart3" onclick="window.location = '/shopping-cart.php'"></i>
    </nav>
    <div id="item_list">
        <?php
        foreach ($items as $item) {
                ?>
        <div class="item">
            <!--<p class="sold_out_banner">new drop</p>-->
            <div class="img_container" onclick="window.location = 'item.php?item=<?php echo $item['ID']; ?>'">
                <img src="<?php echo $item['product_pic_url'] ?>" alt="">
<!--                <div class="text_container">-->
                    <!--<div class="color_wrapper">
                        <div class="color_preview" style="background-color: #ff2929"></div>
                        <div class="color_preview" style="background-color: #e3e3e3"></div>
                        <div class="color_preview" style="background-color: #000000"></div>
                    </div>-->

<!--                </div>-->
            </div>
            <h2><?php echo $item['product_name'] ?></h2>
            <div>
                <p><?php echo $item['product_price'] ?> BGN</p>
                <!--<button onclick="window.location = 'item.php?item=<?php /*echo $item['ID']; */?>'">Buy</button>-->
            </div>
        </div>
                <?php
            }
        ?>
    </div>
    <footer>
        <div>
            <h2>Necto Clothing</h2>
            <p>📍 based in Varna, BG</p>
            <div style="display: flex; flex-direction: column; gap: 5px">
                <a href="/privacy"># Our privacy commitment</a>
                <a href="/privacy"># Impressum</a>
                <a href="/privacy"># EU-Help Center for online purchases</a>
            </div>
        </div>
        <div>
            <div style="display: flex; flex-direction: column; gap: 5px">
                <a href="tel:+4915253036128">Tel: 015253036128</a>
                <a href="mailto:contact@necto-clothing.com">Mail: contact@necto-clothing.com</a>
                <span>Musterstraße 46,<br>48151 Varna</span>
            </div>
        </div>
    </footer>
    <div id="bg">
    </div>
    <script src="main.js"></script>
    <script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.0/firebase-app.js";
        import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.7.0/firebase-analytics.js";
        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries

        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        const firebaseConfig = {
            apiKey: "AIzaSyB1YqjsNt6Mv4ovqRTIUPIXancEUfZozeg",
            authDomain: "necto-dfceb.firebaseapp.com",
            projectId: "necto-dfceb",
            storageBucket: "necto-dfceb.appspot.com",
            messagingSenderId: "386154409103",
            appId: "1:386154409103:web:f275c32536f7076c32d4fa",
            measurementId: "G-BE06XZHY0M"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const analytics = getAnalytics(app);
    </script>
</body>
</html>