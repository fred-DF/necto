<x-layout>
    <x-slot name="content">
        <div id="nav-bar">
            <img src="../../src/logo.png" alt="" id="logo" draggable="false">
            <p style="color: white;">📍 Varna, BR<br>Handmade desings & hight quality</p>
            <a href="." style="color: white;">Zurück</a>
        </div>
        <div id="pieces" style="padding: 5px">
            <div id="shoppingCart">
            </div>
            <div class="spaced_list">
                <div>
                    <p>Versand</p>
                    <p>Gesamt</p>
                </div>
                <div>
                    <p>5 BRG</p>
                    <p id="price">-</p>
                </div>
            </div>
            <button style="width: 100%; background-color: white; color: black; border: none; padding: 10px 0; font-family: 'Space Mono', monospace; font-weight: bold">Jetzt Kaufen</button>
        </div>
        <div id="footer">
            <div id="content">
                <h3>Necto Clothing</h3>
                <p>Based in Varna, BR</p>
                <a href="https://www.instagram.com/necto.clothing/">Instagram</a>
                <a href="legal">Legal Resources</a>
                <p>(c) '23 Necto Clothing</p>
            </div>
        </div>
        <img src="../../src/bg-desktop.jpg" alt="" id="bg" draggable="false">
        <script>

            function loadShoppingCart () {
                totalPrice = 5;
                document.getElementById('shoppingCart').innerHTML = "";
                let shoppingCart = JSON.parse(localStorage.getItem('shoppingCart'));
                shoppingCart.products.forEach(product => {
                    const div = document.createElement("div");
                    div.id = "shopping_cart_view";
                    // Produkt Bild
                    const img = document.createElement("img");
                    img.src = "../product_pictures/" + product.picUrl;
                    img.draggable = false;
                    img.classList.add("product_pic_small");
                    // 1. Spalte
                    const column_1 = document.createElement("div");
                    const name = document.createElement("p");
                    name.style.fontWeight = 600;
                    name.innerText = product.name;
                    const price_color = document.createElement("p");
                    price_color.innerText = product.size + " / " + product.color;
                    column_1.appendChild(name);
                    column_1.appendChild(price_color);
                    // 2. Spalte
                    const column_2 = document.createElement("div");
                    const price = document.createElement("p");
                    price.innerText = product.price + " BRG";
                    const remove = document.createElement("p");
                    remove.classList.add("link");
                    remove.innerText = "Löschen";
                    remove.addEventListener("click", () => {
                        let shoppingCart = JSON.parse(localStorage.getItem('shoppingCart'));
                        shoppingCart.products = shoppingCart.products.filter(item => item.id !== product.id);
                        localStorage.setItem('shoppingCart', JSON.stringify(shoppingCart));
                        loadShoppingCart();
                    });
                    column_2.appendChild(price);
                    column_2.appendChild(remove);
                    // Div zusammensetzen
                    div.appendChild(img);
                    const column_div = document.createElement("div");
                    column_div.classList.add("spaceBetween");
                    column_div.appendChild(column_1);
                    column_div.appendChild(column_2);
                    div.appendChild(column_div);
                    document.getElementById('shoppingCart').appendChild(div);
                    totalPrice = totalPrice + parseInt(product.price);
                });
                document.getElementById('price').innerText = totalPrice + " BRG";
            }

            let shoppingCart = JSON.parse(localStorage.getItem('shoppingCart'));
            let totalPrice = 5;
            if(shoppingCart.products.length == 0) {
                document.getElementById('shoppingCart').innerHTML = "Keine Produkte im Wahrenkorb";
            } else {
                loadShoppingCart();
            }
        </script>
    </x-slot>
</x-layout>
