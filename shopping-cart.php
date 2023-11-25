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
<?php
include "navbar.php";









?>
    <div id="shopping-cart-page">
        <div style="display: flex; justify-content: center; flex-direction: column">
            <?php

            if(isset($_GET['productSoldOut'])) {
                ?>
                <div style="padding: 30px 35px;  width: fit-content; background-color: rgba(255,0,0,0.34); border: 2px solid #ff0000;">
                    <h2>OOP'S, one of your items isn't on stock any longer</h2>
                    <p>It seems like on of your selected products is gone sold out since you put it in your shopping cart. We're sorry that we can't give you detailed information's.</p>
                </div>
                <?php
            }
            ?>
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

        const createCartElement = (data, color, size) => {
            console.log(data)
            const div = document.createElement('div');
            const p_div = document.createElement('div');
            div.classList.add("shopping-cart-item-div");
            const img = document.createElement('img');
            const divl = document.createElement('div');
            img.src = data.product_pic_url;
            const name = document.createElement('p');
            name.innerText = data.product_name;
            name.classList.add("product-name");
            const price = document.createElement('p');
            price.innerText = data.product_price + " BGR";
            price.classList.add("product-price");
            const divr = document.createElement('div');
            divr.classList.add("div_r");
            const del = document.createElement('p');
            del.classList.add("product-delete");
            del.innerText = "Delete";
            const sizecolor = document.createElement('p');
            sizecolor.classList.add("size-delete");
            sizecolor.innerText = color + ", " + size;
            const bg_img = document.createElement('img');
            bg_img.src = data.product_pic_url;
            bg_img.classList.add("bg_img");
            div.appendChild(img);
            divl.appendChild(name);
            divl.appendChild(price);
            divr.appendChild(del);
            divr.appendChild(del);
            divr.appendChild(sizecolor);
            p_div.appendChild(divl);
            p_div.appendChild(divr);
            div.appendChild(p_div);
            div.appendChild(bg_img);
            list.appendChild(div);
        };

        const processShoppingCartElement = async (element) => {
            try {
                const data = await getproductInfo(element.id);
                // ['stripe_price_id'=>'price_1NsJqTB0uesfVsSs85bB0UJq','id'=>1,'color'=>'red','size'=>'M','name'=>'Mixed Feelings']
                stripeShoppingCart.push({ stripe_price_id: data.stripe_pice_id, id: data.ID, color: element.color, size: element.size, name: data.product_name });
                createCartElement(data, element.color, element.size);
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

    </script>
</body>
</html>