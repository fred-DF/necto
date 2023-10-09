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
    <title>Document</title>
</head>
<body>
    <h1 style="text-align: center">Shopping Cart</h1>
    <div id="shopping-cart-page">
        <div style="display: flex; justify-content: center">
            <span class="loader" id="loader"></span>
            <div id="list" style="display: none"></div>
        </div>
        <div>
            <h2>Pay now</h2>
            <p>Pay directly with our payment partner Stripe.</p>
            <button class="large" id="stripePaymentButton">Pay</button>
        </div>
    </div>
    <script>
        let shoppingCart = JSON.parse(localStorage.getItem('shopping-cart'));
        let list = document.getElementById('list');
        let stripeShoppingCart = [];

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

        const createCartElement = (data) => {
            const div = document.createElement('div');
            const p_div = document.createElement('div');
            div.classList.add("shopping-cart-item-div");
            const img = document.createElement('img');
            img.src = data.product_pic_url;
            const name = document.createElement('p');
            name.innerText = data.product_name;
            name.classList.add("product-name");
            const price = document.createElement('p');
            price.innerText = data.product_price + " BGR";
            price.classList.add("product-price");
            div.appendChild(img);
            p_div.appendChild(name);
            p_div.appendChild(price);
            div.appendChild(p_div);
            list.appendChild(div);
        };

        const processShoppingCartElement = async (element) => {
            try {
                const data = await getproductInfo(element.id);
                stripeShoppingCart.push({ price: data.stripe_pice_id, quantity: 1 });
                createCartElement(data);
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
                window.location = '<?php echo $_ENV['API_PATH']; ?>?route=create-checkout-session&shopping-cart=' + JSON.stringify(stripeShoppingCart);
            });
        }).catch((error) => {
            console.error('One of the requests failed:', error);
        });

    </script>
</body>
</html>