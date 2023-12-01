<?php
    require_once 'bootstrap.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="shopping-cart.css">
    <title>Shopping Cart | Necto Clothing</title>
</head>
<body>
<nav>
    <h1>Necto Clothing</h1>
    <i class="bi bi-cart3" onclick="window.location = '/shopping-cart.php'"></i>
</nav>
<?php

if(isset($_GET['productSoldOut'])) {
    ?>
    <div style="padding: 30px 35px;  width: fit-content; background-color: rgba(255,0,0,0.34); border: 2px solid #ff0000; margin: 30px auto">
        <h2>OOP'S, one of your items isn't on stock any longer</h2>
        <p>It seems like on of your selected products is gone sold out since you put it in your shopping cart. We're sorry that we can't give you detailed information's.</p>
    </div>
    <?php
}
?>
    <div id="shopping-cart-page">
        <div style="display: flex; justify-content: center; flex-direction: column">
            <span class="loader" id="loader"></span>
            <div id="list" style="display: none"></div>
            <div style="display: flex; justify-content: right">
                <span id="total_price"><span id="price">00</span><div><span id="decimal">.00</span><span>BGN</span></div></span>
            </div>
        </div>
        <div class="buttontext">
            <span id="text">Pay with stripe to finish your order. There you can pay with Apple Pay, Google Pay, Kredit / Debit Card and many more.</span>
            <button class="large" id="stripePaymentButton">Pay with <svg viewBox="0 0 60 25" xmlns="http://www.w3.org/2000/svg" width="40" height="16" class="UserLogo variant-- "><title>Stripe logo</title><path fill="#ffffff" d="M59.64 14.28h-8.06c.19 1.93 1.6 2.55 3.2 2.55 1.64 0 2.96-.37 4.05-.95v3.32a8.33 8.33 0 0 1-4.56 1.1c-4.01 0-6.83-2.5-6.83-7.48 0-4.19 2.39-7.52 6.3-7.52 3.92 0 5.96 3.28 5.96 7.5 0 .4-.04 1.26-.06 1.48zm-5.92-5.62c-1.03 0-2.17.73-2.17 2.58h4.25c0-1.85-1.07-2.58-2.08-2.58zM40.95 20.3c-1.44 0-2.32-.6-2.9-1.04l-.02 4.63-4.12.87V5.57h3.76l.08 1.02a4.7 4.7 0 0 1 3.23-1.29c2.9 0 5.62 2.6 5.62 7.4 0 5.23-2.7 7.6-5.65 7.6zM40 8.95c-.95 0-1.54.34-1.97.81l.02 6.12c.4.44.98.78 1.95.78 1.52 0 2.54-1.65 2.54-3.87 0-2.15-1.04-3.84-2.54-3.84zM28.24 5.57h4.13v14.44h-4.13V5.57zm0-4.7L32.37 0v3.36l-4.13.88V.88zm-4.32 9.35v9.79H19.8V5.57h3.7l.12 1.22c1-1.77 3.07-1.41 3.62-1.22v3.79c-.52-.17-2.29-.43-3.32.86zm-8.55 4.72c0 2.43 2.6 1.68 3.12 1.46v3.36c-.55.3-1.54.54-2.89.54a4.15 4.15 0 0 1-4.27-4.24l.01-13.17 4.02-.86v3.54h3.14V9.1h-3.13v5.85zm-4.91.7c0 2.97-2.31 4.66-5.73 4.66a11.2 11.2 0 0 1-4.46-.93v-3.93c1.38.75 3.1 1.31 4.46 1.31.92 0 1.53-.24 1.53-1C6.26 13.77 0 14.51 0 9.95 0 7.04 2.28 5.3 5.62 5.3c1.36 0 2.72.2 4.09.75v3.88a9.23 9.23 0 0 0-4.1-1.06c-.86 0-1.44.25-1.44.9 0 1.85 6.29.97 6.29 5.88z" fill-rule="evenodd"></path></svg></button>
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
        let shoppingCart = JSON.parse(localStorage.getItem('shopping-cart'));
        let list = document.getElementById('list');
        let stripeShoppingCart = [];
        let counter = 0;
        let total = 0;

        const getproductInfo = async (productId) => {
            try {
                const response = await fetch(`<?php echo $_ENV['API_PATH']; ?>?route=get-product-info&product-id=${productId}`);
                const [data] = await response.json();
                return data;
            } catch (error) {
                console.error('Error fetching product info:', error);
                throw error;
            }
        };

        const createCartElement = (data, color, size, id) => {
            console.log(data)
            const div = document.createElement('div');
            const p_div = document.createElement('div');
            div.classList.add("shopping-cart-item-div");
            const img = document.createElement('img');
            const divt = document.createElement('div');
            img.src = data.product_pic_url;
            const name = document.createElement('p');
            name.innerText = data.product_name;
            name.classList.add("product-name");
            const price = document.createElement('p');
            price.innerText = data.product_price + " BGN";
            price.classList.add("product-price");
            const divb = document.createElement('div');
            divb.classList.add("div_b");
            const del = document.createElement('p');
            del.classList.add("product-delete");
            del.innerHTML = "<i class='bi bi-x'></i>";
            del.onclick = () => { deleteItem(id) };
            const sizecolor = document.createElement('p');
            sizecolor.classList.add("size-delete");
            sizecolor.innerText = color + ", " + size;
            div.appendChild(img);
            divt.appendChild(name);
            divt.appendChild(del);
            divb.appendChild(sizecolor);
            divb.appendChild(price);
            p_div.appendChild(divt);
            p_div.appendChild(divb);
            div.appendChild(p_div);
            list.appendChild(div);
        };

        const processShoppingCartElement = async (element) => {
            try {
                const data = await getproductInfo(element.id);
                // ['stripe_price_id'=>'price_1NsJqTB0uesfVsSs85bB0UJq','id'=>1,'color'=>'red','size'=>'M','name'=>'Mixed Feelings']
                stripeShoppingCart.push({ stripe_price_id: data.stripe_price_id, id: data.ID, color: element.color, size: element.size, name: data.product_name });
                createCartElement(data, element.color, element.size, counter);
                total = total + parseInt(data.product_price);
                document.getElementById('price').innerText = total;
                counter = counter + 1;
            } catch (error) {
                console.error('Error:', error);
            }
        };

        // Mapping each shopping cart element to a Promise
        const promises = shoppingCart.map(element => processShoppingCartElement(element));

        // Wait for all Promises to resolve
        Promise.all(promises).then(() => {
            console.log(stripeShoppingCart);
            document.getElementById('loader').style.display = 'none';
            document.getElementById('list').style.display = 'block';
            document.getElementById('stripePaymentButton').disabled = false;
            document.getElementById('stripePaymentButton').addEventListener('click', () => {
                window.location = '<?php echo $_ENV['API_PATH']; ?>?route=checkout&shopping-cart=' + JSON.stringify(stripeShoppingCart);
            });
        }).catch((error) => {
            console.error('One of the requests failed:', error);
        });

        function deleteItem (id) {
            let shoppingCart = JSON.parse(localStorage.getItem('shopping-cart'))
            shoppingCart.splice(id, 1);
            console.log("DELETING ELEMENT " + id);
            localStorage.setItem('shopping-cart', JSON.stringify(shoppingCart));
            window.location.reload();
        }

    </script>
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