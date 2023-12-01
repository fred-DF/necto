<?php

require_once 'bootstrap.php';

if(isset($_GET['item'])) {
    $item = [database::select('products', ['conditions' => [["ID", $_GET['item']]]])[0]];
    $item = $item[0];

    $variants = database::select('product_variants', ['conditions' => [['product_ID', $_GET['item']]]]);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="item.css">
    <title><?php echo $item['product_name'] ?> | Necto Clothing</title>
</head>
<body>
<nav>
    <h1>Necto Clothing</h1>
    <i class="bi bi-cart3" onclick="window.location = '/shopping-cart.php'"></i>
</nav>
    <div id="item_page">
        <img src="<?php echo $item['product_pic_url']; ?>" alt="" id="productImg">
        <div>
            <h2><?php echo $item['product_name'] ?></h2>
            <form method="GET" id="itemForm">
            <h3>Color:</h3>
            <?php
            foreach (json_decode($item['product_colors'])->colors as $color) {
                ?>
                <fieldset><input onclick="loadImg('<?php echo $color ?>'); checkAvailability('<?php echo $color ?>'); " type="radio" id="colors" name="color" value="<?php echo $color ?>" required><label for="mc"><?php echo $color ?></label></fieldset>
                <?php
            }
            ?>
            <h3>Sizes:</h3>
                <div id="sizes">
                    <?php
                    foreach (json_decode($item['product_sizes'])->sizes as $size) {
                        echo "<fieldset><input type='radio' id='sizes' name='size' value='{$size}' required><label for='mc'>{$size}</label></fieldset>";
                    }
                    ?>
                </div>
            <div id="actionZone">
                <div id="price"><?php echo $item['product_price'];?> BGR</div>
                <button type="submit">Add to Shopping Cart</button>
            </div>
            <p style="color: rgb(128,128,128); font-size: small">Shipping in calculated in the payment process</p>
            </form>
        </div>
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
    <script>
        function loadImg (color) {
            <?php
            echo "const variants = {'null':'null'";
            foreach (json_decode($item['product_colors'])->colors as $color) {
                $pic_url = database::select('product_variants', ['conditions' => [["product_ID", $item['ID']],["product_color", $color]]])[0]['product_pic_url'];
                echo ",'".$color."': '".$pic_url."'";
            }
            echo "};";
            ?>

            document.getElementById('productImg').src = variants[color];
        }

        document.getElementById('itemForm').addEventListener("submit", (e) => {
            e.preventDefault();
            const form  = new FormData(document.getElementById('itemForm'));
            const product = <?php echo $item['ID']; ?>;
            const size = form.get("size");
            const color = form.get("color");
            if(localStorage.getItem("shopping-cart") == null || localStorage.getItem("shopping-cart") === "") {
                localStorage.setItem("shopping-cart", "[]")
            }
            let shopping_cart = localStorage.getItem('shopping-cart');
            console.log(shopping_cart);
            shopping_cart = JSON.parse(shopping_cart);
            console.log(shopping_cart)
            shopping_cart.push({"id":product,"size":size,"color":color});
            localStorage.setItem("shopping-cart", JSON.stringify(shopping_cart));
        });

        function checkAvailability (color)
        {
            const varinats = [
                <?php

                foreach ($variants as $variant) {
                    echo json_encode($variant).",";
                }
                ?>
            ];

            let result = varinats.filter(variant => variant.product_color === color);

            console.log(result)

            document.getElementById('sizes').innerHTML = "";

            result.forEach((element) => {

                const fieldset = document.createElement('fieldset');

                const input = document.createElement('input');
                input.type = "radio";
                input.id = "sizes";
                input.name = "size";
                input.value = element.product_size;

                const label = document.createElement('label');
                label.innerText = element.product_size;

                fieldset.appendChild(input);
                fieldset.appendChild(label);

                document.getElementById('sizes').appendChild(fieldset)

            });

            return result;
        }
    </script>
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
