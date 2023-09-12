<x-layout>
    <x-slot name="content">
        <link rel="stylesheet" href="../../app.css">
        <div id="nav-bar">
            <img src="../../src/logo.png" alt="" id="logo" draggable="false">
            <p style="color: white;">📍 Varna, BR<br>Handmade desings & hight quality</p>
            <div class="spaceBetween">
                <a href="../../">Zurück</a>
                <a href="../../shopping-cart" style="color: white;">Wahrenkorb (<span id="shoppingCartItemCount">0</span>)</a>
            </div>
        </div>

        <div id="pieces" style="padding: 5px>

            <div id="boxesWrapper">
                <div class="box">

                    <canvas id="canvas" style="height: 250px !imporant; width: 100% !important"></canvas>

                    <!-- <img src="src/product_images/mixed_feelings_23.jpg" alt=""> -->
                    <p class="pieceName">{{ $item['name'] }}</p>
                    <div>
                        <p class="price">{{ $item['price'] }} BRG</p>
                        <p class="sizes">{{ $item['sizes'] }}</p>
                    </div>
                </div>
                <button class="button" onclick="addShoppingCart('{{ $item['name'] }}','{{ $item['price'] }}','{{ $item['colors'] }}','{{ $item['sizes'] }}', '{{ $item['pic_url'] }}')">In den Warenkorb</button>
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
        <script src="../../shopping-cart.js"></script>
        <img src="../../src/bg-desktop.jpg" alt="" id="bg" draggable="false">
        <script type="module">
        import * as THREE from 'https://unpkg.com/three@0.126.1/build/three.module.js';

        import { GLTFLoader  } from 'https://unpkg.com/three@0.126.1/examples/jsm/loaders/GLTFLoader.js';

        const canvas = document.getElementById('canvas');
        const renderer = new THREE.WebGLRenderer({ canvas, alpha: true });
        const scene = new THREE.Scene();

        renderer.setSize(canvas.clientWidth, canvas.clientHeight);

        const camera = new THREE.PerspectiveCamera(75, canvas.clientWidth / canvas.clientHeight, 0.1, 3000);
        camera.position.z = 3;  // Entfernung der Kamera vom T-Shirt
        camera.position.y = 3; // Vertikale Position der Kamera
        camera.lookAt(0, 3, 0); // Blickrichtung der Kamera auf den Ursprung

        const loader = new GLTFLoader();
        let model;

        loader.load('../../glb/{{ $item['glb_urls'] }}.glb', (gltf) => {
            model = gltf.scene;
            scene.add(model);

            const ambientLight = new THREE.AmbientLight(0xffffff, 3); // Zweites Argument ist die Intensität
            scene.add(ambientLight);

            // Startwerte für die Rotation
            model.rotation.x = 0;
            model.rotation.y = 0;
            model.rotation.z = 0;

        });

        const animate = () => {
            requestAnimationFrame(animate);
            if (model) {
            // Drehe das Modell in jedem Animationsframe
            model.rotation.x += 0.000; // Ändere diese Werte nach Bedarf
            model.rotation.y += 0.005;
            model.rotation.z += 0.000;
            }
            renderer.render(scene, camera);
        };

        animate();
        </script>
    </x-slot>
</x-layout>
