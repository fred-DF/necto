<x-layout>
    <x-slot name="content">
        <div id="nav-bar">
            <img src="src/logo.png" alt="" id="logo" draggable="false">
            <p style="color: white;">📍 Varna, BR<br>Handmade desings & hight quality</p>
            <div class="spaceBetween">
                <p></p>
                <a href="shopping-cart" style="color: white;">Wahrenkorb (<span id="shoppingCartItemCount">0</span>)</a>
            </div>
        </div>
        <div id="pieces">
            <span class="label">COLLECTION</span><br>
            <select name="" id="collectionSelector">
                <option value="">View all</option>
                <option value="">Summer '23</option>
                <option value="">Winter '22</option>
            </select>
            <div id="boxesWrapper">
                @foreach ($products as $product)
                    <div class="box" onclick="window.location = 'item/{{ $product['name'] }}'">
                        <img src="/product_pictures/{{ $product['pic_url']  }}" alt="">
                        <p class="pieceName">{{ $product['name'] }}</p>
                        <div>
                            <p class="price">{{ $product['price'] }} BRG</p>
                            <p class="sizes">{{ $product['sizes'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div id="footer">
            <div id="content">
                <h3>Necto Clothing</h3>
                <p>Based in Varna, BR</p>
                <a href="https://www.instagram.com/necto.clothing/">Instagram</a>
                <a href="legal">Leagal Resources</a>
                <p>(c) '23 Necto Clothing</p>
            </div>
        </div>
        <img src="src/bg-desktop.jpg" alt="" id="bg" draggable="false">
        <script src="shopping-cart.js"></script>
    </x-slot>
</x-layout>
